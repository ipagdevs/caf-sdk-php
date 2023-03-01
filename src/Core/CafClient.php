<?php

namespace Yshybashy\Caf\Core;

use Yshybashy\Caf\Core\Client;
use Yshybashy\Caf\Http\Client\GuzzleHttpClient;
use Yshybashy\Caf\IO\JsonSerializer;
use Yshybashy\Caf\Model\Onboarding;
use Yshybashy\Caf\Model\OnboardingRequest;
use Yshybashy\Caf\Model\Transaction;
use Yshybashy\Caf\Model\TransactionRequest;

class CafClient extends Client
{
    protected string $authorizationKey;

    public function __construct(string $authorizationKey)
    {
        parent::__construct(
            new CafEnvironment(),
            new GuzzleHttpClient(),
            new JsonSerializer()
        );

        $this->useAuthorizationKey($authorizationKey);
    }

    public function useAuthorizationKey(string $key): void
    {
        $this->authorizationKey = $key;
    }

    public function createTransaction(TransactionRequest $request): Transaction
    {
        $data = $this->post(
            "/v1/transactions",
            $request->jsonSerialize(),
            ['origin' => 'TRUST'],
            ['Authorization' => $this->authorizationKey]
        );

        $response = new Transaction($data->getParsed());

        return $response;
    }

    public function getTransactions(array $query = []): array
    {
        $data = $this->get(
            "/v1/transactions",
            $query,
            ['Authorization' => $this->authorizationKey]
        );

        $response = array_map(
            fn (array $item) => new Transaction($item),
            $data->getParsedPath('items')
        );

        return $response;
    }

    public function getTransaction(string $id): Transaction
    {
        $data = $this->get(
            "/v1/transactions/$id",
            [],
            ['Authorization' => $this->authorizationKey]
        );

        $response = new Transaction($data->getParsed());

        return $response;
    }

    public function createOnboarding(OnboardingRequest $request): Onboarding
    {
        $data = $this->post(
            "/v1/onboardings",
            $request->jsonSerialize(),
            ['origin' => 'TRUST'],
            ['Authorization' => $this->authorizationKey]
        );

        $response = new Onboarding($data->getParsed());

        return $response;
    }
}
