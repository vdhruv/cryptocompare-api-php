<?php

namespace Vdhruv\CryptoCompare\Services;

use Vdhruv\CryptoCompare\CryptoCompare;

abstract class CryptoService
{
    /**
     * @var CryptoCompare
     */
    protected $cryptoCompare;

    /**
     * CryptoHistory constructor.
     * @param CryptoCompare $cryptoCompare
     */
    public function __construct(CryptoCompare $cryptoCompare)
    {
        $this->cryptoCompare = $cryptoCompare;
    }
}