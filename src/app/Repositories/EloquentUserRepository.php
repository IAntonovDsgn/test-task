<?php

namespace App\Repositories;

use App\Models\User;

class EloquentUserRepository
{
    public function createUser(array $userData): User | bool
    {
        return User::create($userData);
    }

    public function updateUser(User $user, array $userData): bool
    {
        return $user->update($userData);
    }

    public function updatePhoto(User $user, string $path): bool
    {
        return $user->update(['photo' => $path]);
    }

    public function updatePassword(User $user, string $password): bool
    {
        return $user->update(['password' => $password]);
    }

    public function getPassword(User $user): string
    {
        return $user->password;
    }
}
