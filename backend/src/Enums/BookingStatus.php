<?php

namespace Knilo\PhpSydProj\Enums;

enum BookingStatus: string
{
    case Pending = 'pending';
    case Confirmed = 'confirmed';
    case Cancelled = 'cancelled';
    case Completed = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Waiting',
            self::Confirmed => 'Accepted',
            self::Cancelled => 'Canceled',
            self::Completed => 'done',
        };
    }
}
