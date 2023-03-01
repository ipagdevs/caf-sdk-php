<?php

namespace Kyc\Caf\Model;

use JsonSerializable;
use Kubinyete\Assertation\Assert;
use Kyc\Caf\Util\ArrayUtil;

class TransactionRequest implements JsonSerializable
{
    protected array $attributes;
    protected array $files;
    protected array $metadata;
    protected string $templateId;
    protected ?string $callbackUrl;

    public function __construct(string $templateId)
    {
        $this->templateId = $templateId;
        $this->attributes = [];
        $this->files = [];
        $this->metadata = [];
        $this->callbackUrl = null;
    }


    public function getTemplateId(): string
    {
        return $this->templateId;
    }

    public function setTemplateId(string $value): void
    {
        $this->templateId = $value;
    }

    public function useCpf(string $value): void
    {
        $this->attributes['cpf'] = Assert::value($value, __FUNCTION__)->asCpf(false)->validate()->get();
    }

    public function useRg(string $value): void
    {
        $this->attributes['rg'] = $value;
    }

    public function useName(string $value): void
    {
        $this->attributes['name'] = $value;
    }

    public function useBirthDate(string $value): void
    {
        $this->attributes['birthDate'] = $value;
    }

    public function useFatherName(string $value): void
    {
        $this->attributes['fatherName'] = $value;
    }

    public function useMotherName(string $value): void
    {
        $this->attributes['motherName'] = $value;
    }

    public function useUf(string $value): void
    {
        $this->attributes['uf'] = $value;
    }

    public function useCnpj(?string $value): void
    {
        $this->attributes['cnpj'] = Assert::value($value, __FUNCTION__)->asCnpj(false)->validate()->get();
    }

    public function useCep(string $value): void
    {
        $this->attributes['cep'] = $value;
    }

    public function useEmail(string $value): void
    {
        $this->attributes['email'] = Assert::value($value, __FUNCTION__)->email()->validate()->get();
    }

    public function usePhoneNumber(string $value): void
    {
        $this->attributes['phoneNumber'] = $value;
    }

    public function includeFile(File $file): void
    {
        $this->files[] = $file;
    }

    public function useMetadata(string $key, $value): void
    {
        $this->metadata[$key] = $value;
    }

    public function useCallbackUrl(string $callbackUrl): void
    {
        $this->callbackUrl = Assert::value($callbackUrl, __FUNCTION__)->url()->or()->domain()->or()->ip()->validate()->get();
    }

    public function jsonSerialize()
    {
        $options = [
            'templateId' => $this->templateId,
            'attributes' => $this->attributes,
            'files' => array_map(fn (File $f) => $f->jsonSerialize(), $this->files),
            'metadata' => (object) $this->metadata,
        ];

        if ($this->callbackUrl) {
            ArrayUtil::set('_callbackUrl', $options, $this->callbackUrl);
        }

        return $options;
    }
}
