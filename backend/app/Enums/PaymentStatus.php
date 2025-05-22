<?php
namespace App\Enums;

enum PaymentStatus: int
{
    case Pending = 0;
    case Paid = 1;
    case Failed = 2;

    public function label(): string
    {
        return match($this) {
            self::Pending => 'Kutilmoqda',
            self::Paid => 'To‘landi',
            self::Failed => 'Muvaffaqiyatsiz',
        };
    }
}
