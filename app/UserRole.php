<?php
namespace App;

enum UserRole: string
{
    case Admin = 'admin';
    case Member = 'member';

    // Buat method untuk opsi select
    public static function options(): array
    {
        return [
            self::Admin->value => 'Administrator',
            self::Member->value => 'Member',
        ];
    }

    // Optional: method label() untuk instance enum
    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Administrator',
            self::Member => 'Member',
        };
    }
}
