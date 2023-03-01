<?php

namespace Yshybashy\Caf\IO;

interface SerializerInterface
{
    function serialize(array $data): string;
    function unserialize(string $data): array;
}
