<?php

declare(strict_types=1);

namespace App\Enum;

enum ConfidenceLevel: string
{
    case LOW    = 'low';
    case MEDIUM = 'medium';
    case HIGH   = 'high';

    public function label(): string
    {
        return match($this) {
            self::LOW    => 'Faible',
            self::MEDIUM => 'Moyen',
            self::HIGH   => 'Élevé',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::LOW    => 'orange',
            self::MEDIUM => 'blue',
            self::HIGH   => 'green',
        };
    }
}