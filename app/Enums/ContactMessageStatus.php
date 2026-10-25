<?php

namespace App\Enums;

enum ContactMessageStatus: string
{
    case New = 'new';
    case Read = 'read';
    case Replied = 'replied';
    case Archived = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::New => 'Baru',
            self::Read => 'Dibaca',
            self::Replied => 'Dibalas',
            self::Archived => 'Diarsipkan',
        };
    }

    public function stampClass(): string
    {
        return match ($this) {
            self::New => 'stamp-cobalt',
            self::Read => 'stamp-manila',
            self::Replied => 'stamp-success',
            self::Archived => 'stamp-stamp',
        };
    }
}
