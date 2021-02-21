<?php

namespace Vdhruv\CryptoCompare\Services;

use Vdhruv\CryptoCompare\CryptoConfig;

class CryptoPrice extends CryptoService
{
    use CryptoConfig;

    /**
     * @param string|null $symbol
     * @param array $currencies
     * @param int $aggregate
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSingleSymbolPrice(string $symbol = null, array $currencies = [], $aggregate = 1)
    {
        $parameters = [
            'fsym' => $this->resolveSymbol($symbol),
            'tsyms' => $this->resolveCurrencies($currencies),
            'e' => $aggregate
        ];

        return $this->cryptoCompare->request('/data/price', $parameters);
    }

    public function getMultipleSymbolPrice(array $symbols = [], array $currencies = [], $aggregate = 1)
    {
        $parameters = [
            'fsyms' => $this->resolveSymbols($symbols),
            'tsyms' => $this->resolveCurrencies($currencies),
            'e' => $aggregate
        ];

        return $this->cryptoCompare->request('/data/pricemulti', $parameters);
    }

    /**
     * @param array $symbols
     * @param array $currencies
     * @param int $aggregate
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMultipleSymbolFullData(array $symbols = [], array $currencies = [], $aggregate = 1)
    {
        $parameters = [
            'fsyms' => $this->resolveSymbols($symbols),
            'tsyms' => $this->resolveCurrencies($currencies),
            'e' => $aggregate
        ];

        return $this->cryptoCompare->request('/data/pricemultifull', $parameters);
    }
}