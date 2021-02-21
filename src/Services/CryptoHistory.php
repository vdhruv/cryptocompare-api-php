<?php

namespace Vdhruv\CryptoCompare\Services;

use Vdhruv\CryptoCompare\CryptoConfig;

class CryptoHistory extends CryptoService
{
    use CryptoConfig;

    /**
     * Get open, high, low, close, volumefrom and volumeto from the daily historical data.
     *
     * @param string|null $symbol
     * @param string|null $currency
     * @param int $aggregate
     * @param int $limit
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDailyHistory(string $symbol = null, string $currency = null, $aggregate = 1, int $limit = 2000)
    {
        return $this->history(
            '/data/v2/histoday',
            $this->resolveSymbol($symbol),
            $this->resolveCurrency($currency),
            $aggregate,
            $limit
        );
    }

    /**
     * Get open, high, low, close, volumefrom and volumeto from the hourly historical data.
     *
     * @param string|null $symbol
     * @param string|null $currency
     * @param int $aggregate
     * @param int $limit
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getHourlyHistory(string $symbol = null, string $currency = null, $aggregate = 1, int $limit = 2000)
    {
        return $this->history(
            '/data/v2/histohour',
            $this->resolveSymbol($symbol),
            $this->resolveCurrency($currency),
            $aggregate,
            $limit
        );
    }

    /**
     * Get open, high, low, close, volumefrom and volumeto from the each minute historical data.
     *
     * @param string|null $symbol
     * @param string|null $currency
     * @param int $aggregate
     * @param int $limit
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMinuteHistory(string $symbol = null, string $currency = null, $aggregate = 1, int $limit = 2000)
    {
        return $this->history(
            '/data/v2/histominute',
            $this->resolveSymbol($symbol),
            $this->resolveCurrency($currency),
            $aggregate,
            $limit
        );
    }

    /**
     * @param string|null $symbol
     * @param string|null $currency
     * @param int $aggregate
     * @param int $limit
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDailySymbolVolume(string $symbol = null, string $currency = null, $aggregate = 1, int $limit = 2000)
    {
        return $this->history(
            '/data/symbol/histoday',
            $this->resolveSymbol($symbol),
            $this->resolveCurrency($currency),
            $aggregate,
            $limit
        );
    }

    /**
     * @param string|null $symbol
     * @param string|null $currency
     * @param int $aggregate
     * @param int $limit
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getHourlySymbolVolume(string $symbol = null, string $currency = null, $aggregate = 1, int $limit = 2000)
    {
        return $this->history(
            '/data/symbol/histohour',
            $this->resolveSymbol($symbol),
            $this->resolveCurrency($currency),
            $aggregate,
            $limit
        );
    }

    /**
     * get requested historical data
     *
     * @param string $uri
     * @param string|null $symbol
     * @param string|null $currency
     * @param $aggregate
     * @param int $limit
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function history(string $uri, string $symbol, string $currency, $aggregate, int $limit)
    {
        $parameters = [
            'fsym' => $symbol,
            'tsym' => $currency,
            'limit' => $limit,
            'aggregate' => $aggregate
        ];

        return $this->cryptoCompare->request($uri, $parameters);
    }
}