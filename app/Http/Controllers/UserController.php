<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckEmailRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdatePhotoUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

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

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = User::create($request->all());
        Auth::login($user);
        return back();
    }

    public function login(LoginUserRequest $request, UserService $userService): JsonResponse
    {
        return response()->json($userService->attemptAuth(
            $request->input('email'),
            $request->input('password')
        ));
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return back();
    }

    public function update(UpdateUserRequest $request)
    {

    }

    public function updatePhoto(UpdatePhotoUserRequest $request)
    {
        $user = Auth::user();

        if ($user->photo) {
            Storage::delete('public/' . $user->photo);
        }

        $path = $request->file('photo')->store('photos', 'public');
        $user->photo = $path;
        $user->save();

        return back();
    }

    public function checkEmail(CheckEmailRequest $request, UserService $userService): JsonResponse
    {
        if ($userService->emailExists($request->input('email'))) {
            return response()->json(['unavailable' => 'Этот email уже занят']);
        }

        return response()->json();
    }

    public function passRecovery()
    {
        return view('user.password-recovery');
    }
}
