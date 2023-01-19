<?php

namespace App\Infrastructure\Exchange;

use App\Infrastructure\Models\Currency;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

/**
 * @see https://www.amdoren.com/currency-api/
 * @package App\Infrastructure\Exchange
 */
class Amdoren implements Exchange
{
    private string $key;
    private string $baseUri = 'https://www.amdoren.com/api/currency.php';
    private Client $client;
    private array $clientBaseQuery;
    private int $cacheExpirationInSeconds = 3600;

    public function __construct()
    {
        if (!env('AMDOREN_API_KEY')) {
            throw new \Exception('Missing exchanger api key.');
        }

        $this->key = env('AMDOREN_API_KEY');
        $this->client = new Client(['base_uri' => $this->baseUri]);
        $this->clientBaseQuery = ['api_key' => $this->key];
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
            'from' => $from->code,
            'to' => $to->code,
            'amount' => 1,
        ]];

        $responseStream = $this->client->get('', $query);

        $response = json_decode($responseStream->getBody()->getContents());

        if ($response->error) {
            throw new \Exception('Error on getting rate data.');
        }

        $value = (float) $response->amount;

        Cache::put($fromToString, $value, $this->cacheExpirationInSeconds);

        return $value;
    }
}
