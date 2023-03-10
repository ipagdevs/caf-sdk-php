<?php

namespace Kyc\Caf\Http;

use Kyc\Caf\IO\JsonSerializer;
use Kyc\Caf\IO\MutatorInterface;
use Kyc\Caf\IO\SerializerInterface;
use Kyc\Caf\Util\ArrayUtil;

class Response
{
    protected ?SerializerInterface $serializer;
    protected ?array $data;
    protected ?string $raw;

    protected function __construct(?SerializerInterface $serializer, ?string $body)
    {
        $this->raw = $body;
        $this->serializer = $serializer;
        $this->data = null;
    }

    public function getParsed(): ?array
    {
        return $this->data ??
            ($this->data = $this->serializer ? $this->serializer->unserialize($this->raw) : null);
    }

    public function getParsedPath(string $dotNotation, $default = null)
    {
        return ArrayUtil::get($dotNotation, $this->getParsed(), $default);
    }

    public function getBody(): ?string
    {
        return $this->raw;
    }

    public function setSerializer(?SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
    }

    //

    public static function from(?string $data): self
    {
        return new static(null, $data);
    }
}
