<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Yshybashy\Caf\Core\CafClient;
use Yshybashy\Caf\Model\OnboardingRequest;
use Yshybashy\Caf\Model\Transaction;
use Yshybashy\Caf\Model\TransactionRequest;
use Yshybashy\Caf\Model\Type;

class CafClientTest extends TestCase
{
    protected CafClient $client;

    protected function setUp()
    {
        $this->client = new CafClient(getenv('CAFTOKEN'));
    }

    protected function tearDown()
    {
    }

    public function testClientCanListTransactions()
    {
        $items = $this->client->getTransactions();

        $this->assertTrue(is_array($items));
        if ($items) {
            $this->assertInstanceOf(Transaction::class, $items[0]);
            return $items[0]->getData()['id'];
        }
    }

    /**
     * @depends testClientCanListTransactions
     */
    public function testClientCanGetTransaction(string $id)
    {
        $item = $this->client->getTransaction($id);
        $this->assertInstanceOf(Transaction::class, $item);
    }

    public function testClientCanPostTransaction()
    {
        $request = new TransactionRequest('63fca70fad52c8000893e981');
        $response = $this->client->createTransaction($request);
        $this->assertArrayHasKey('requestId', $response);
        $this->assertArrayHasKey('id', $response);
    }
    public function testClientCanPostOnboarding()
    {
        $request = new OnboardingRequest(Type::pf(), '63fca701ad52c8000893e97f');

        $response = $this->client->createOnboarding($request);
        $this->assertArrayHasKey('requestId', $response);
        $this->assertArrayHasKey('id', $response);
    }
}
