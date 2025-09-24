<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardRepository
{
    /**
     * Get today's orders and compare with yesterday
     */
    public static function todayOrders(): array
    {
        // Get today's and yesterday's date
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        // Count orders
        $todayCount = Transaction::whereDate('date', $today)->count();
        $yesterdayCount = Transaction::whereDate('date', $yesterday)->count();

        // Calculate percentage change safely
        $percentage = $yesterdayCount > 0
            ? round((($todayCount - $yesterdayCount) / $yesterdayCount) * 100, 2)
            : ($todayCount > 0 ? 100 : 0);

        return [
            'label' => 'Pesanan Hari Ini',
            'count' => $todayCount,
            'description' => $percentage >= 0 ? "{$percentage}% naik dibanding kemarin" : "{$percentage} turun dibanding kemarin"
        ];
    }

    /**
     * Get this month's orders and compare with last month
     */
    public static function monthlyOrders(): array
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        $currentCount = Transaction::whereBetween('date', [$startOfMonth, $endOfMonth])->count();
        $lastCount = Transaction::whereBetween('date', [$lastMonthStart, $lastMonthEnd])->count();

        $percentage = $lastCount > 0
            ? round((($currentCount - $lastCount) / $lastCount) * 100, 2)
            : ($currentCount > 0 ? 100 : 0);

        return [
            'label' => 'Pesanan Bulan Ini',
            'count' => $currentCount,
            'description' => $percentage >= 0 ? "{$percentage}% naik dibanding bulan lalu" : "{$percentage} turun dibanding bulan lalu"

        ];
    }

    /**
     * Get new customers today and compare with yesterday
     */
    public static function newCustomersToday(): array
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        $todayCount = Customer::whereDate('created_at', $today)->count();
        $yesterdayCount = Customer::whereDate('created_at', $yesterday)->count();

        $percentage = $yesterdayCount > 0
            ? round((($todayCount - $yesterdayCount) / $yesterdayCount) * 100, 2)
            : ($todayCount > 0 ? 100 : 0);

        return [
            'label' => 'Pelanggan Baru Hari Ini',
            'count' => $todayCount,
            'description' => $percentage >= 0 ? "{$percentage}% naik dibanding kemarin" : "{$percentage} turun dibanding kemarin"
        ];
    }

    /**
     * Example card: today's revenue
     */
    public static function todayRevenue(): array
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        $todayAmount = Transaction::whereDate('date', $today)->sum('total');
        $yesterdayAmount = Transaction::whereDate('date', $yesterday)->sum('total');

        $percentage = $yesterdayAmount > 0
            ? round((($todayAmount - $yesterdayAmount) / $yesterdayAmount) * 100, 2)
            : ($todayAmount > 0 ? 100 : 0);

        return [
            'label' => 'Pendapatan Hari Ini',
            'count' => $todayAmount,
            'description' => $percentage >= 0 ? "{$percentage}% naik dibanding kemarin" : "{$percentage} turun dibanding kemarin"
        ];
    }

    /**
     * Get active orders
     */
    public static function getActiveTransactions()
    {
        $transaction = Transaction::where('status', '!=', 3)->get();
        $count = $transaction->count();

        return [
            'label' => 'Pesanan Aktif',
            'count' => $count,
            'percentage' => null,
            'description' => 'Pesanan belum selesai'
        ];
    }
}
