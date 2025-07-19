<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\EloquentUserRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UserService
{
    public function __construct(
        private readonly EloquentUserRepository $userRepository
    )
    {
    }

    public function attemptAuth(string $email, string $password): void
    {
        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            throw ValidationException::withMessages([
                'login-email' => ['Неверный Email или пароль'],
                'login-password' => ['Неверный Email или пароль'],
            ]);
        }
    }

    public function registerAndAuth(array $data): void
    {
        try {
            $user = $this->userRepository->createUser($data);
            Auth::login($user);
        } catch (\Exception $e) {
            throw new \RuntimeException($e);
        }
    }

    public function update(Authenticatable $user, array $data): void
    {
        try {
            $this->checkPassword($user, $data['password']);
        } catch (ValidationException $e) {
            throw ValidationException::withMessages($e->errors());
        }

        $updateData = [];
        if (isset($data['name'])) {
            $updateData['name'] = $data['name'];
        }
        if (isset($data['email'])) {
            $updateData['email'] = $data['email'];
        }

        if (!empty($updateData)) {
            if (!$this->userRepository->updateUser($user, $updateData)) {
                throw ValidationException::withMessages([
                    'error' => 'Ошибка обновления данных пользователя'
                ]);
            }
        }
    }

    public function updatePhoto(Authenticatable $user, $photo): void
    {
        if ($user->photo) {
            Storage::delete('public/' . $user->photo);
        }

        $path = $photo->store('photos', 'public');

        if (!$this->userRepository->updatePhoto($user, $path)) {
            throw ValidationException::withMessages([
                'error' => 'Ошибка обновления фото пользователя'
            ]);
        }

    }

    public function updatePassword(Authenticatable $user, string $password): array
    {
        if ($this->userRepository->updatePassword($user, $password)) {
            return ['success' => 'Пароль успешно изменён!'];
        } else {
            throw ValidationException::withMessages([
                'new-password' => 'Ошибка обновления пароля',
            ]);
        }

    }

    public function logout(): void
    {
        Auth::logout();
    }

    public function checkPassword(Authenticatable $user, string $password): bool
    {
        if (Hash::check($password, $this->userRepository->getPassword($user))) {
            return true;
        } else {
            throw ValidationException::withMessages([
                'password' => 'Неверный пароль',
            ]);
        }
    }

    public function passwordRecoverySendEmail(array $email): array
    {
        $status = Password::sendResetLink($email);

        if ($status === Password::RESET_LINK_SENT) {
            return ['success' => 'Письмо восстановления отправлено на указанный E-mail адрес'];
        } else {
            throw ValidationException::withMessages([
                'email' => 'Неверный E-mail',
            ]);
        }

    }

    public function resetPassword(array $data): array
    {
        $status = Password::reset(
            $data,
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => $password
                ]);

                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return ['success' => 'Пароль успешно изменён!'];
        } else {
            throw ValidationException::withMessages([
                'email' => 'Неверный E-mail',
            ]);
        }
    }
}
