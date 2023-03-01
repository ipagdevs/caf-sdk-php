<?php

namespace Kyc\Caf\Model;

use Kyc\Caf\Util\ArrayUtil;

class Onboarding
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

    public function getId(): string
    {
        return ArrayUtil::get('id', $this->data);
    }

    public function getRequestId(): string
    {
        return ArrayUtil::get('requestId', $this->data);
    }

    public function getUrl(): string
    {
        return ArrayUtil::get('url', $this->data);
    }
}
