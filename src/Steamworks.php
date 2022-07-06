<?php


use GuzzleHttp\Client;

class Steamworks
{
    private Client $client;
    private string $apiKey;

    private function __construct(Client $client, string $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    public static function create(Client $client, string $apiKey): self
    {
        return new self($client, $apiKey);
    }

    public function getAppNews($appId) : array
    {
        $response = $this->client->request('GET', 'https://api.steampowered.com/ISteamNews/GetNewsForApp/v2', [
            'query' => [
                'appid' => $appId,
                'format' => 'json'
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}