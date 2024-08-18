<?php

namespace App\Services;

use GuzzleHttp\Client;

class RajaOngkirService
{
    protected $client;
    protected $apiKey;
    protected $baseUri;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('RAJAONGKIR_API_KEY', '2d418131a9818f8a33a03e669509aca2');
        $this->baseUri = env('RAJAONGKIR_BASE_URI', 'https://api.rajaongkir.com/starter/');
    }

    public function getProvinces()
    {
        $response = $this->client->get($this->baseUri . 'province', [
            'headers' => [
                'key' => $this->apiKey,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getCities($provinceId)
    {
        $response = $this->client->get($this->baseUri . 'city', [
            'headers' => [
                'key' => $this->apiKey,
            ],
            'query' => [
                'province' => $provinceId,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getCity($id)
    {
        $response = $this->client->get($this->baseUri . 'city', [
            'headers' => [
                'key' => $this->apiKey,
            ],
            'query' => [
                'id' => $id,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getShippingCost($origin, $destination, $weight, $courier)
    {
        $response = $this->client->post($this->baseUri . 'cost', [
            'headers' => [
                'key' => $this->apiKey,
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
