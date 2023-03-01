<?php

namespace Yshybashy\Caf\Model;

class Type
{
    public const PF = 'PF';
    public const PJ = 'PJ';
    public const PF_PF = 'PF_PF';

    protected string $type;

    protected function __construct(string $type = Type::PF)
    {
        $this->type = $type;
    }

    //

    public static function pf(): self
    {
        return new self(self::PF);
    }

    public static function pj(): self
    {
        return new self(self::PJ);
    }

    public static function pfPj(): self
    {
        return new self(self::PF_PF);
    }

    //

    public function getType()
    {
        return $this->type;
    }

    public function setType(string $type)
    {
        return $this->type = $type;
    }

    public function __toString()
    {
        return $this->getType();
    }
}
