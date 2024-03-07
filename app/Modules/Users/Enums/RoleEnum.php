<?php

declare(strict_types=1);

namespace App\Modules\Users\Enums;

enum RoleEnum: string
{
    case USER = 'user';
    case MODERATOR = 'moderator';
    case ADMIN = 'admin';
}
