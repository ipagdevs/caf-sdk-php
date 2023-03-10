<?php

namespace Kyc\Caf\Core;

use Kyc\Caf\Core\Environment;

class CafEnvironment extends Environment
{
    private const PROD_URL = 'https://api.combateafraude.com';
    private const BETA_URL = 'https://api.beta.combateafraude.com';

    public function __construct(bool $production = true)
    {
        parent::__construct($production ? self::PROD_URL : self::BETA_URL);
    }
}
