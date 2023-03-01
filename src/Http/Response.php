<?php

namespace Yshybashy\Caf\Http;

use Yshybashy\Caf\IO\JsonSerializer;
use Yshybashy\Caf\IO\MutatorInterface;
use Yshybashy\Caf\IO\SerializerInterface;
use Yshybashy\Caf\Util\ArrayUtil;

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
