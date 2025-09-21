<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Models\TransactionPay;
use App\Models\TransactionService;
use Exception;
use Illuminate\Support\Facades\Auth;

class TransactionRepository
{
    /**
     * Store a new transaction.
     * @param array $data
     * @return Transaction
     */
    public static function store(array $data): Transaction
    {
        $transaction = Transaction::create(array_merge($data, [
            'total' => collect($data['services'])->sum(fn ($service) => $service['service_price'] * $service['quantity']),
        ]));

        $paymentType = $transaction->payment_status;

        // Store pays if payment type is 0: Paid or 1: Advance pay
        if (in_array($paymentType, [0, 1])) {
            $isDirectPay = $paymentType == 0;
            $amount = $isDirectPay ? $transaction->total : $transaction->total_paid;

            self::storePays($transaction->fresh(), [[
                'amount' => $amount,
                'date' => $transaction->date
            ]]);
        }
        
        return $transaction;
    }

    /**
     * Store pays
     */
    public static function storePays(Transaction $transaction, array $pays): void
    {
        $bill = $transaction->total;
        $totalPaid = (int) $transaction->total_paid;
        $newPays = collect($pays)->whereNull('id');

        $amount = (int) $newPays->sum('amount');
        $newTotalPaid = (int) ($totalPaid + $amount);

        // Validate amout not allowed to greated than total paid after calculation
        if ($newTotalPaid > $bill) {
            throw new Exception("Pembayaran tidak boleh melebihi nominal yang ditagihkan! Sisa pembayaran sebesar " . rupiah((int) $transaction->total - (int) $transaction->total_paid));
        }

        $newPays = $newPays->map(function ($pay) use ($transaction) {
            return [
                'transaction_id' => $transaction->id,
                'amount' => $pay['amount'],
                'date' => $pay['date'],
                'created_by' => Auth::id() ?? 0,
            ];
        })->toArray();

        $transaction->update([
            'total_paid' => $newTotalPaid
        ]);
        
        TransactionPay::insert($newPays); // apa fungsi untuk create banyak sekaligus?
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
