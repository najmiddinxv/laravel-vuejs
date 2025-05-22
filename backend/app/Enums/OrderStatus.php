<?php
namespace App\Enums;

enum OrderStatus: int
{
    case Draft = 0;
    case Confirmed = 1;
    case Shipped = 2;
    case Delivered = 3;

    public function label(): string
    {
        return match($this) {
            self::Draft => 'Qoralama',
            self::Confirmed => 'Tasdiqlangan',
            self::Shipped => 'Jo‘natilgan',
            self::Delivered => 'Yetkazilgan',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Draft => 'secondary',
            self::Confirmed => 'primary',
            self::Shipped => 'warning',
            self::Delivered => 'success',
        };
    }
}

