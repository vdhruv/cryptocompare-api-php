<?php

namespace Vdhruv\CryptoCompare;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use InvalidArgumentException;

class CryptoCompare
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $endpoint = 'https://min-api.cryptocompare.com';

    /**
     * @var array
     */
    protected $options;

    /**
     * CryptoCompare constructor.
     * @param string $apiKey
     * @param array $options
     * @param string $endpoint
     */
    public function __construct(string $apiKey, array $options = [], string $endpoint = null)
    {
        if ($endpoint) {
            $this->endpoint = $endpoint;
        }

        $this->initClient($apiKey);

        $this->options = $options;
    }

    /**
     * @param string $uri
     * @param array $parameters
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(string $uri, array $parameters = [])
    {
        $response = $this->client->get(
            $this->resolveUrl($uri),
            ['query' => $parameters]
        );

        $body = $response->getBody()->getContents();

        return json_decode($body);
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param string $url
     * @return string
     */
    public function resolveUrl(string $url)
    {
        return (rtrim($this->endpoint, '/') . '/' . ltrim($url, '/'));
    }

    /**
     * @return string
     */
    public function getEndPoint()
    {
        return $this->endpoint;
    }

    /**
     * @param string $key
     * @return array
     */
    public function getOption(string $key)
    {
        if (!array_key_exists($key, $this->options))
            throw new InvalidArgumentException("Option name $key does not exists.");

        return $this->options[$key];
    }

    /**
     * @param string $apiKey
     */
    private function initClient(string $apiKey)
    {
        $this->client = new Client([
            'headers' => [
                'Authorization' => 'Apikey ' . $apiKey,
                'Accept' => 'application/json'
            ]
        ]);
    }

    /**
     * @param string $method
     * @param array $parameters
     * @return array[]
     */
    protected function parseParametes(string $method, array $parameters): array
    {
        if ($method == 'get') {
            $parameters = ['query' => $parameters];
        } else {
            $parameters = [RequestOptions::JSON => $parameters];
        }
        return $parameters;
    }
}