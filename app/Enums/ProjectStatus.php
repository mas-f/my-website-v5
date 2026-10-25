<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case Draft = 'draft';
    case Published = 'published';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Published => 'Published',
        };
    }

    public function stampClass(): string
    {
        return match ($this) {
            self::Draft => 'stamp-manila',
            self::Published => 'stamp-success',
        };
    }
}
