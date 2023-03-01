<?php

namespace Yshybashy\Caf\Core;

use Yshybashy\Caf\Core\Environment;

class CafEnvironment extends Environment
{
    public function __construct()
    {
        parent::__construct('https://api.beta.combateafraude.com');
    }
}
