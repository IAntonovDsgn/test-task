<?php

namespace App\Repositories;

use App\Models\User;

class EloquentUserRepository
{
    public function existsByEmail(string $email): bool
    {
        return User::where('email', $email)->exists();
    }
}
