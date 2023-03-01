<?php

namespace Kyc\Caf\Core;

use Kyc\Caf\Core\Environment;

class CafEnvironment extends Environment
{
    public function __construct()
    {
        parent::__construct('https://api.beta.combateafraude.com');
    }
}
