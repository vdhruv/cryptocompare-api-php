<?php

namespace Vdhruv\CryptoCompare\Services;

use Vdhruv\CryptoCompare\CryptoConfig;

class CryptoTrading extends CryptoService
{
    use CryptoConfig;

    /**
     * @param string $symbol
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSymbolTradingSignals(string $symbol)
    {
        $parameters = [
            'fsym' => $this->resolveSymbol($symbol)
        ];

        return $this->cryptoCompare->request('/data/tradingsignals/intotheblock/latest', $parameters);
    }
}