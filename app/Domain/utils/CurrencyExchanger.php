<?php

declare(strict_types=1);

namespace Utils\Domain;

use App\Infrastructure\Models\Currency;
use App\Infrastructure\Exchange\CurrencyConverterApi;
use App\Infrastructure\Exchange\Exchange;

class CurrencyExchanger
{
    private Exchange $exchangeService;

    public function __construct(Exchange $exchangeService = null)
    {
        $this->exchangeService = $exchangeService ?: new CurrencyConverterApi();
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
