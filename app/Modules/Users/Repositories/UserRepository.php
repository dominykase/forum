<?php

declare(strict_types=1);

namespace App\Modules\Users\Repositories;

use App\Models\User;

class UserRepository
{
    public function findByUsername(string $username): User
    {
        return User::query()->where('name', $username)->first();
    }
}
