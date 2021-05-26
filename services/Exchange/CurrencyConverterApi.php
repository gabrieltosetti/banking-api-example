<?php

namespace Services\Exchange;

use App\Models\Currency;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

/**
 * @see https://www.currencyconverterapi.com/docs
 * @package Services\Exchange
 */
class CurrencyConverterApi implements Exchange
{
    private string $key = 'b78e3a13c84eba29c827';
    private string $url = 'https://free.currconv.com/api/v7/convert';
    private Client $client;
    private array $clientBaseQuery;
    private int $cacheExpirationInSeconds = 3600;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => $this->url]);
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
