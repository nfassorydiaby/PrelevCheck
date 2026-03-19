<?php

declare(strict_types=1);

namespace App\Enum;

enum LookupSource: string
{
    case CACHE      = 'cache';
    case DATABASE   = 'database';
    case SEARCH_API = 'search_api';
    case OPENAI     = 'openai';

    public function label(): string
    {
        return match($this) {
            self::CACHE      => 'Cache',
            self::DATABASE   => 'Base de données',
            self::SEARCH_API => 'API de recherche',
            self::OPENAI     => 'Intelligence artificielle',
        };
    }
}