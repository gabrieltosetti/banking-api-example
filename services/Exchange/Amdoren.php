<?php

namespace Services\Exchange;

use App\Models\Currency;
use GuzzleHttp\Client;

/**
 * @see https://www.amdoren.com/currency-api/
 * @package Services\Exchange
 */
class Amdoren implements Exchange
{
    private string $key = '4YcqDpRs6m9U8buSeh7gS57JFjBNm2';
    private string $url = 'https://www.amdoren.com/api/currency.php';
    private Client $client;
    private array $clientBaseQuery;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => $this->url]);
        $this->clientBaseQuery = ['api_key' => $this->key];
    }

    public function getRate(Currency $from, Currency $to): float
    {
        $toCode = $to->code;

        $query = ['query' => $this->clientBaseQuery + [
            'from' => $from->code,
            'to' => $toCode,
            'amount' => 1,
        ]];

        $responseStream = $this->client->get('', $query);

        $response = json_decode($responseStream->getBody()->getContents());

        if ($response->error) {
            throw new \Exception('Error on getting rate data.');
        }

        return floor($response->amount * 100) / 100;
    }
}
