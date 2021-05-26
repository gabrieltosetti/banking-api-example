<?php

namespace Services\Exchange;

use App\Models\Currency;
use GuzzleHttp\Client;

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
     * @return float Returns a float with 3 decimal places
     */
    public function getRate(Currency $from, Currency $to): float
    {
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

        return floor($response->rates->{$toCode} * 1000) / 1000;
    }
}
