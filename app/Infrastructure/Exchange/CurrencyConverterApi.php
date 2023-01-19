<?php

declare(strict_types=1);

namespace App\Infrastructure\Exchange;

use App\Infrastructure\Models\Currency;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

/**
 * @see https://www.currencyconverterapi.com/docs
 * @package App\Infrastructure\Exchange
 */
class CurrencyConverterApi implements Exchange
{
    private string $key;
    private string $baseUri = 'https://free.currconv.com/api/v7/convert';
    private Client $client;
    private array $clientBaseQuery;
    private int $cacheExpirationInSeconds = 3600;

    public function __construct()
    {
        if (!env('CURRENCY_CONVERTER_API_API_KEY')) {
            throw new \Exception('Missing exchanger api key.');
        }

        $this->key = env('CURRENCY_CONVERTER_API_API_KEY');
        $this->client = new Client(['base_uri' => $this->baseUri]);
        $this->clientBaseQuery = ['apiKey' => $this->key, 'compact' => 'ultra'];
    }

    /**
     * Get the exchange rate between 2 currencies
     *
     * @param Currency $from 
     * @param Currency $to 
     * 
     * @return float
     */
    public function getRate(Currency $from, Currency $to): float
    {
        $fromToString = $from->code . '_' . $to->code;

        if (Cache::has($fromToString)) {
            return Cache::get($fromToString);
        }

        $query = ['query' => $this->clientBaseQuery + [
            'q' => $fromToString,
        ]];

        $responseStream = $this->client->get('', $query);

        $response = json_decode($responseStream->getBody()->getContents());

        if (empty($response->{$fromToString})) {
            throw new \Exception('Error on getting rate data.');
        }

        $value = (float) $response->{$fromToString};

        Cache::put($fromToString, $value, $this->cacheExpirationInSeconds);

        return $value;
    }
}
