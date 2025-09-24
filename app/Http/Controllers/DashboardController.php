<?php

namespace App\Http\Controllers;

use App\Repositories\DashboardRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $todayOrders = DashboardRepository::todayOrders();
        $monthlyOrders = DashboardRepository::monthlyOrders();
        $newCustomersToday = DashboardRepository::newCustomersToday();
        $todayRevenue = DashboardRepository::todayRevenue();
        $activeTransactions = DashboardRepository::getActiveTransactions();
        
        return view('pages.dashboard.index', compact('todayOrders', 'monthlyOrders', 'newCustomersToday', 'todayRevenue', 'activeTransactions'));
    }
}
