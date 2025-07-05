<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\PasswordRecoveryRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdatePhotoUserRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index(): View
    {
        return view('user.profile');
    }

    public function auth(): View
    {
        return view('user.authentication');
    }

    public function store(StoreUserRequest $request, UserService $userService): RedirectResponse
    {
        $userService->registerAndAuth($request->validated());
        return back();
    }

    public function login(LoginUserRequest $request, UserService $userService): RedirectResponse
    {
        try {
            $userService->attemptAuth(
                $request->input('login-email'),
                $request->input('login-password')
            );
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }

        $request->session()->regenerate();
        return redirect()->route('user.index');
    }

    public function logout(UserService $userService): RedirectResponse
    {
        $userService->logout();
        return back();
    }

    public function update(UpdateUserRequest $request, UserService $userService): RedirectResponse
    {
        try {
            $userService->update(Auth::user(), $request->validated());
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }
        return back();
    }

    public function updatePhoto(UpdatePhotoUserRequest $request, UserService $userService): RedirectResponse
    {
        $photo = $request->file('photo');
        $userService->updatePhoto(Auth::user(), $photo);
        return back();
    }

    public function updatePassword(UpdateUserPasswordRequest $request, UserService $userService): RedirectResponse
    {
        try {
            $userService->checkPassword(Auth::user(), $request->input('oldPassword'));
            $status = $userService->updatePassword(Auth::user(), $request->input('newPassword'));
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }
        return back()->with($status);
    }

    public function passwordRecovery(): View
    {
        return view('user.password-recovery');
    }

    public function passwordRecoverySendEmail(UserService $userService, PasswordRecoveryRequest $request): RedirectResponse
    {
        try {
            $status = $userService->passwordRecoverySendEmail($request->only('email'));
            return back()->with($status);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }
    }

    public function resetPassword(string $token): View
    {
        return view('user.reset-password', ['token' => $token]);
    }

    public function resetPasswordStore(ResetPasswordRequest $request, UserService $userService): RedirectResponse
    {
        try {
            $status = $userService->resetPassword($request->only('email', 'password', 'password_confirmation', 'token'));
            return redirect()->route('user.auth')->with($status);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }
    }

}
