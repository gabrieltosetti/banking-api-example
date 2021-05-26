<?php

namespace Services\Exchange;

use App\Models\Currency;

interface Exchange
{
    public function getRate(Currency $from, Currency $to): float;
}