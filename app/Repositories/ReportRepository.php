<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Transaction;
use App\Models\TransactionPay;
use App\Models\User;

class ReportRepository
{
    /**
     * Enums for report page
     */
    public static array $getReportTitleEnums = [
        'TRANSACTIONS'  => 'Laporan Transaksi',
        'REVENUE' => 'Laporan Pendapatan',
        'NEW_CUSTOMERS' => 'Laporan Pelanggan Baru',
        'TOP_CUSTOMERS'      => 'Laporan Pelanggan Terbaik',
    ];

    public function getRangedTransactions($fromDate, $endDate)
    {
        $transactions = Transaction::query()
            ->when($fromDate && $endDate, function ($query) use ($fromDate, $endDate) {
                $query->whereBetween('date', [$fromDate, $endDate]);
            })
            ->get();

        return $transactions;
    }

    public function getRevenueData($fromDate, $endDate)
    {
        $query = TransactionPay::query()
            ->selectRaw('DATE(date) as transaction_date, SUM(amount) as total_revenue')
            ->groupBy('transaction_date')
            ->orderBy('transaction_date', 'asc');

        if (!empty($fromDate) && !empty($endDate)) {
            $query->whereBetween('date', [$fromDate, $endDate]);
        }

        return $query->get();
    }

    public function getNewCustomers($fromDate, $endDate)
    {
        $query = Customer::query()
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc');

        if (!empty($fromDate) && !empty($endDate)) {
            $query->whereBetween('created_at', [$fromDate, $endDate]);
        }

        return $query->get();
    }

    public function getTopCustomers($fromDate, $endDate)
    {
        $query = Transaction::query()
            ->selectRaw('customer_id, SUM(total) as total_amount, COUNT(*) as transaction_count, MAX(date) as last_transaction_date')
            ->when($fromDate && $endDate, function ($query) use ($fromDate, $endDate) {
                $query->whereBetween('date', [$fromDate, $endDate]);
            })
            ->groupBy('customer_id')
            ->orderBy('transaction_count', 'desc');

        return $query->get();
    }
}
