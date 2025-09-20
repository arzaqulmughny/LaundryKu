<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Models\TransactionService;

class TransactionRepository
{
    /**
     * Store a new transaction.
     * @param array $data
     * @return Transaction
     */
    public static function store(array $data): Transaction
    {
        return Transaction::create($data);
    }

    /**
     * Update or create transaction services.
     * @param Transaction $transaction
     * @param array $services
     * @return bool
     */
    public static function upsertServices(Transaction $transaction, array $services): bool
    {
        $serviceIds = collect($services)->map(function ($serviceData) use ($transaction) {
            if (!empty($serviceData['id'])) {
                $service = TransactionService::findOrFail($serviceData['id']);
                $service->update($serviceData);
                return $service->id;
            }

            return TransactionService::create(array_merge($serviceData, [
                'transaction_id' => $transaction->id,
            ]))->id;
        })->toArray();

        $transaction->services()
            ->whereNotIn('id', $serviceIds)
            ->delete();

        return true;
    }
}
