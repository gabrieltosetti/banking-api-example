<?php

declare(strict_types=1);

namespace App\Infrastructure\Exchange;

use App\Infrastructure\Models\Currency;

interface Exchange
{
    public function getRate(Currency $from, Currency $to): float;
}