<?php

namespace Kyc\Caf\Model;

use JsonSerializable;
use Kyc\Caf\Model\Type;
use Kyc\Caf\Util\ArrayUtil;

class OnboardingRequest implements JsonSerializable
{
    protected Type $type;
    protected string $transactionTemplateId;

    protected array $attributes;
    protected array $variables;
    protected string $email = '';

    protected bool $noExpire = true;
    protected ?string $transactionQsaTemplateId = null;
    protected ?string $transactionPFTemplateId = null;
    protected ?string $templateId = null;
    protected ?string $smsPhoneNumber = null;

    public function __construct(Type $type, string $transactionTemplateId)
    {
        $this->type = $type;
        $this->transactionTemplateId = $transactionTemplateId;
        $this->attributes = [];
        $this->variables = [];
    }

    public function useTransactionQsaTemplateId(string $transactionQsaTemplateId): void
    {
        $this->transactionQsaTemplateId = $transactionQsaTemplateId;
    }

    public function useTransactionPFTemplateId(string $transactionPFTemplateId): void
    {
        $this->transactionPFTemplateId = $transactionPFTemplateId;
    }

    public function useTemplateId(string $templateId): void
    {
        $this->templateId = $templateId;
    }

    public function useSmsPhoneNumber(string $smsPhoneNumber): void
    {
        $this->smsPhoneNumber = $smsPhoneNumber;
    }

    public function useNoExpire(bool $noExpire): void
    {
        $this->noExpire = $noExpire;
    }

    public function useEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setType(Type $type): void
    {
        $this->type = $type;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    public function getTransactionTemplateId(): string
    {
        return $this->transactionTemplateId;
    }

    public function setTransactionTemplateId(string $transactionTemplateId): void
    {
        $this->transactionTemplateId = $transactionTemplateId;
    }

    public function useCpf(string $cpf): void
    {
        $this->attributes['cpf'] = $cpf;
    }

    public function useVariable(string $key, string $value): void
    {
        $this->variables[$key] = $value;
    }

    public function useCnpj(string $cnpj): void
    {
        $this->attributes['cnpj'] = $cnpj;
    }

    public function jsonSerialize()
    {
        $data = [
            "type"                      => $this->type,
            "transactionTemplateId"     => $this->transactionTemplateId,
            "templateId"                => $this->templateId,
            "transactionPFTemplateId"   => $this->transactionPFTemplateId,
            "transactionQsaTemplateId"  => $this->transactionQsaTemplateId,
            "email"                     => $this->email,
            "smsPhoneNumber"            => $this->smsPhoneNumber,
            "noExpire"                  => $this->noExpire,
            "variables"                 => (object) $this->variables,
            "attributes"                => $this->attributes
        ];

        return ArrayUtil::array_filter_recursive($data, true);
    }
}
