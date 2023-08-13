<?php

namespace App\Service;

use GuzzleHttp\Client;

class CallApiService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getTeams(): array
    {
        $response = $this->client->request('GET', 'https://free-nba.p.rapidapi.com/teams?page=0', [
            'headers' => [
                'X-RapidAPI-Host' => 'free-nba.p.rapidapi.com',
                'X-RapidAPI-Key' => '1c091c85d4msh6a0456eaccc958ap1f80c2jsne7fc2f278e62',
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
    public function getMatches(): array
    {
        $response = $this->client->request('GET', 'https://free-nba.p.rapidapi.com/games?page=0', [
            'headers' => [
                'X-RapidAPI-Host' => 'free-nba.p.rapidapi.com',
                'X-RapidAPI-Key' => '1c091c85d4msh6a0456eaccc958ap1f80c2jsne7fc2f278e62',
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
