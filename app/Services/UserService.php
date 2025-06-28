<?php

namespace App\Services;

use App\Repositories\EloquentUserRepository;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function __construct(private readonly EloquentUserRepository $repository)
    {
    }

    public function attemptAuth(string $email, string $password): array
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return ['all' => 'success'];
        }

        if (!$this->emailExists($email)) {
            return ['email' => 'Неверный email'];
        }

        return ['password' => 'Неверный пароль'];
    }

    public function emailExists(string $email): bool
    {
        return $this->repository->existsByEmail($email);
    }
}
