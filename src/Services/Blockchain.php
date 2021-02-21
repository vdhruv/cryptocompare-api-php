<?php

namespace Vdhruv\CryptoCompare\Services;

use Vdhruv\CryptoCompare\CryptoConfig;

class Blockchain extends CryptoService
{
    use CryptoConfig;

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCoinList()
    {
        return $this->cryptoCompare->request('data/blockchain/list', []);
    }

    /**
     * @param string|null $symbol
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSymbolLatestData(string $symbol = null)
    {
        $parameters = ['fysm' => $this->resolveSymbol($symbol)];

        return $this->cryptoCompare->request('data/blockchain/latest', $parameters);
    }

    /**
     * @param string|null $symbol
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSymbolDailyHistory(string $symbol = null)
    {
        $parameters = ['fysm' => $this->resolveSymbol($symbol)];

        return $this->cryptoCompare->request('data/blockchain/histo/day', $parameters);
    }

    /**
     * @param array $symbols
     * @param array $currencies
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMiningCalculatorData(array $symbols = [], array $currencies = [])
    {
        $parameters = [
            'fysms' => $this->resolveSymbols($symbols),
            'tsyms' => $this->resolveCurrencies($currencies)
        ];

        return $this->cryptoCompare->request('/data/blockchain/mining/calculator', $parameters);
    }
}