<?php

namespace Yshybashy\Caf\Model;

use Yshybashy\Caf\Util\ArrayUtil;

class Transaction
{
    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getStatus(): string
    {
        return ArrayUtil::get('status', $this->data);
    }

    public function getCreatedAt(): string
    {
        return ArrayUtil::get('createdAt', $this->data);
    }

    public function getId(): string
    {
        return ArrayUtil::get('id', $this->data);
    }

    public function getCnpj(): string
    {
        return ArrayUtil::get('data.cnpj', $this->data);
    }
}
