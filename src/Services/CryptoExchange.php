<?php

namespace Vdhruv\CryptoCompare\Services;

use Vdhruv\CryptoCompare\CryptoConfig;

class CryptoExchange extends CryptoService
{
    use CryptoConfig;

    /**
     * Get total volume from the daily historical exchange data.
     *
     * @param string|null $currency
     * @param int $aggregate
     * @param int $limit
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDailyExchangeVolume(string $currency = null, $aggregate = 1, int $limit = 2000)
    {
        return $this->exchange(
            '/data/exchange/histoday',
            $this->resolveCurrency($currency),
            $aggregate,
            $limit
        );
    }

    /**
     * @param string|null $currency
     * @param int $aggregate
     * @param int $limit
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getHourlyExchangeVolume(string $currency = null, $aggregate = 1, int $limit = 2000)
    {
        return $this->exchange(
            '/data/exchange/histohour',
            $this->resolveCurrency($currency),
            $aggregate,
            $limit
        );
    }

    /**
     * get volume from historical exchange data
     *
     * @param string $uri
     * @param string $currency
     * @param $aggregate
     * @param int $limit
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function exchange(string $uri, string $currency, $aggregate, int $limit)
    {
        $parameters = [
            'tsym' => $currency,
            'aggregate' => $aggregate,
            'limit' => $limit
        ];

        return $this->cryptoCompare->request($uri, $parameters);
    }
}