<?php

namespace Vdhruv\CryptoCompare;

trait CryptoConfig
{
    /**
     * @param string|null $symbol
     * @return string|null
     */
    public function resolveSymbol(string $symbol = null)
    {
        if (!$symbol) {
            $symbol = $this->cryptoCompare->getOption('symbol');
        }

        return $symbol;
    }

    /**
     * @param array $symbols
     * @return array
     */
    public function resolveSymbols(array $symbols = [])
    {
        if (!$symbols) {
            $symbols = [$this->cryptoCompare->getOption('symbol')];
        }

        return $symbols;
    }

    /**
     * @param string|null $currency
     * @return string|null
     */
    public function resolveCurrency(string $currency = null)
    {
        if (!$currency) {
            $currency = $this->cryptoCompare->getOption('currency');
        }

        return $currency;
    }

    /**
     * @param array $currencies
     * @return array
     */
    public function resolveCurrencies(array $currencies = [])
    {
        if (!$currencies) {
            $currency = [$this->cryptoCompare->getOption('currency')];
        }

        return $currency;
    }
}