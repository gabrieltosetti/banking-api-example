<?php

namespace Services\Exchange;

use App\Models\Currency;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

/**
 * @see https://fixer.io/documentation
 * @package Services\Exchange
 */
class Fixer implements Exchange
{
    private string $key = '24a5fc13c31e80246585071d0652e36a';
    private string $url = 'http://data.fixer.io/api/latest';
    private Client $client;
    private array $clientBaseQuery;
    private int $cacheExpirationInSeconds = 3600;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => $this->url]);
        $this->clientBaseQuery = ['access_key' => $this->key];
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

        $toCode = $to->code;

        $query = ['query' => $this->clientBaseQuery + [
            'base' => $from->code,
            'symbols' => $toCode,
        ]];

        $responseStream = $this->client->get('', $query);

        $response = json_decode($responseStream->getBody()->getContents());

        if (!$response->success) {
            throw new \Exception('Error on getting rate data.');
        }

        $value = (float) $response->rates->{$toCode};

        Cache::put($fromToString, $value, $this->cacheExpirationInSeconds);

        return $value;
    }
}
