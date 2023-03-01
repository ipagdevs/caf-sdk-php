<?php

namespace Yshybashy\Caf\Model;

use JsonSerializable;

class File implements JsonSerializable
{
    public const TYPE_RG_FRONT = 'RG_FRONT';
    public const TYPE_RG_BACK = 'RG_BACK';
    public const CRLV = 'CRLV';
    public const CNH_BACK = 'CNH_BACK';
    public const CNH_FRONT = 'CNH_FRONT';
    public const SELFIE  = 'SELFIE';


    protected string $value;
    protected string $type;

    public function __construct(string $base64Value, string $type)
    {
        $this->value = $base64Value;
        $this->type = $type;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'value' => $this->value,
            'type' => $this->type,
        ];
    }
}
