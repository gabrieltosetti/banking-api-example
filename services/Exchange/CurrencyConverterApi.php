<?php

namespace Services\Exchange;

use App\Models\Currency;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RuntimeException;

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
     * @return float Returns a float with 3 decimal places
     */
    public function getRate(Currency $from, Currency $to): float
    {
        $fromToQuery = $from->code . '_' . $to->code;

        $query = ['query' => $this->clientBaseQuery + [
            'q' => $fromToQuery,
        ]];

        $responseStream = $this->client->get('', $query);

        $response = json_decode($responseStream->getBody()->getContents());

        if (empty($response->{$fromToQuery})) {
            throw new \Exception('Error on getting rate data.');
        }

        $value = $response->{$fromToQuery};

        return floor($value * 1000) / 1000;
    }
}
