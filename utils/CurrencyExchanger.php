<?php

namespace Utils;

use App\Models\Currency;
use Services\Exchange\Exchange;

class CurrencyExchanger {
    private Exchange $exchangeService;

    public function __construct(Exchange $exchangeService)
    {
        $this->exchangeService = $exchangeService;
    }

    public function convert(Currency $from, Currency $to, $value)
    {
        $rate = $this->exchangeService->getRate($from, $to);

        return [
            'value' => $value * $rate,
            'rate' => $rate,
        ];
    }
}