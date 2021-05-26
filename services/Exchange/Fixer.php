<?php

namespace Services\Exchange;

use App\Models\Currency;

class Fixer implements Exchange
{
    public function getRate(Currency $from, Currency $to): float
    {
        if ($to->code === 'BRL') return 5.0;
        if ($to->code === 'USD') return 0.2;
        return 1.0;
    }
}
