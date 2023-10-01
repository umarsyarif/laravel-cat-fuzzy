<?php

namespace App\Enums;

enum UserRoles: string
{
    case Admin = 'admin';
    case Teacher = 'teacher';
    case Student = 'student';

    public static function create_user_dropdown(): array
    {
        return array_filter(self::cases(), fn ($v) => $v != UserRoles::Student);
    }
}
