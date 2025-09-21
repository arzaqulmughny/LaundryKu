<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\TransactionPay;
use App\Models\TransactionService;
use App\Models\User;
use App\Repositories\TransactionRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Store transaction with direct pay (paid)
     */
    public function test_success_store_transaction()
    {
        $this->actingAs(User::factory()->create());

        // MOCK DATA
        $service = Service::factory()->create();

        $data = [
            'customer_id' => Customer::factory()->create()->id,
            'date' => now()->format('Y-m-d'),
            'due_date' => now()->format('Y-m-d'),
            'payment_status' => 0,

            'services' => [
                [
                    'service_id' => $service->id,
                    'service_name' => $service->name,
                    'service_unit' => $service->unit,
                    'service_price' => $service->price,
                    'quantity' => 10,
                    // total calculated automatically
                ],
            ]
        ];

        // CALL FUNCTION
        $transaction = TransactionRepository::store($data);
        TransactionRepository::upsertServices($transaction, $data['services']);

        // ASSERT
        // Header stored
        $this->assertDatabaseHas(Transaction::class, [
            'customer_id' => $data['customer_id'],
            'date' => $data['date'],
            'due_date' => $data['due_date'],
            'payment_status' => 0,
        ]);

        // Services stored
        $this->assertDatabaseCount(TransactionService::class, count($data['services']));

        $this->assertDatabaseHas(TransactionService::class, [
            'transaction_id' => $transaction->id,
            'service_id' => $data['services'][0]['service_id'],
            'service_name' => $data['services'][0]['service_name'],
            'service_unit' => $data['services'][0]['service_unit'],
            'service_price' => $data['services'][0]['service_price'],
            'quantity' => $data['services'][0]['quantity'],
        ]);

        // Pay stored
        $this->assertDatabaseCount(TransactionPay::class, 1);
        $this->assertDatabaseHas(TransactionPay::class, [
            'amount' => $transaction->total,
            'transaction_id' => $transaction->id,
            'date' => $transaction->date
        ]);
    }

    /**
     * Store new pay
     */
    public function test_success_store_new_pay_into_existing_transaction()
    {
        // MOCK DATA
        $this->actingAs(User::factory()->create());
        $customer = Customer::factory()->create();

        $transaction = Transaction::create([
            'date' => now()->format('Y-m-d'),
            'due_date' => now()->format('Y-m-d'),
            'status' => 0,
            'customer_id' => $customer->id,
            'payment_status' => 1,
            'created_by' => Auth::id(),
            'total' => 10000,
            'total_paid' => 5000,
        ]);

        TransactionPay::create([
            'transaction_id' => $transaction->id,
            'amount' => 5000,
            'date' => now()->format('Y-m-d'),
            'created_by' => Auth::id(),
        ]);

        // CALL FUNCTION
        TransactionRepository::storePays($transaction, [[
            'amount' => 5000,
            'date' => now()->addDay(-1)->format('Y-m-d')
        ]]);

        // ASSERT
        // Pay stored
        $this->assertDatabaseCount(TransactionPay::class, 2);

        // Total paid increased
        $this->assertEquals(10000, $transaction->fresh()->total_paid);
    }

    /**
     * Should throw error if pays greather than bill
     */
    public function test_failed_store_pay_if_greater_than_bill()
    {
        // MOCK DATA
        $this->actingAs(User::factory()->create());
        $customer = Customer::factory()->create();

        $transaction = Transaction::create([
            'date' => now()->format('Y-m-d'),
            'due_date' => now()->format('Y-m-d'),
            'status' => 0,
            'customer_id' => $customer->id,
            'payment_status' => 1,
            'created_by' => Auth::id(),
            'total' => 10000,
            'total_paid' => 5000,
        ]);

        TransactionPay::create([
            'transaction_id' => $transaction->id,
            'amount' => 5000,
            'created_by' => Auth::id(),
            'date' => now()->format('Y-m-d')
        ]);

        // CALL FUNCTION
        $this->assertThrows(function () use ($transaction) {
            TransactionRepository::storePays($transaction, [[
                'amount' => 10000
            ]]);
        });

        // Total paid should not updated
        $this->assertEquals(5000, $transaction->fresh()->total_paid);

        // Pays not stored
        $this->assertDatabaseCount(TransactionPay::class, 1);
    }
}
