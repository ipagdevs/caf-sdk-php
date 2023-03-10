<?php

namespace Kyc\Caf\Core;

use Kyc\Caf\Core\Client;
use Kyc\Caf\Http\Client\GuzzleHttpClient;
use Kyc\Caf\IO\JsonSerializer;
use Kyc\Caf\Model\Onboarding;
use Kyc\Caf\Model\OnboardingRequest;
use Kyc\Caf\Model\Transaction;
use Kyc\Caf\Model\TransactionRequest;

class CafClient extends Client
{
    protected string $authorizationKey;

    public function __construct(string $authorizationKey, bool $production = true)
    {
        parent::__construct(
            new CafEnvironment($production),
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

    public function getTransactions(array $query = [], string $origin = "TRUST"): array
    {
        $query['origin'] = $origin;
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
            ['origin' => 'TRUST'],
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
