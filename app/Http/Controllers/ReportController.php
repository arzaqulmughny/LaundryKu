<?php

namespace App\Http\Controllers;

use App\Exports\NewCustomersExport;
use App\Exports\RevenuesExport;
use App\Exports\TopCustomersExport;
use App\Exports\TransactionsExport;
use App\Models\Transaction;
use App\Repositories\ReportRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    protected $reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;    
    }

    /**
     * Show index page
     */
    public function index(Request $request)
    {
        $reportEnums = ReportRepository::$getReportTitleEnums;
        $submit = $request->boolean('submit');

        if (!$submit) {
            return view('pages.reports.index', compact('reportEnums'));
        }

        return $this->export($request);
    }

    public function export(Request $request)
    {
        $title = $request->string('title');
        $fileName = strtolower($title) . ' - LaundryKu.xlsx';

        $fromDate = $request->date('from_date') ?? "1999-01-01";
        $endDate = $request->date('end_date') ?? now()->format('Y-m-d');
 
        switch ($title) {
            case 'TRANSACTIONS':
                $transactions = $this->reportRepository->getRangedTransactions($fromDate, $endDate);
                return Excel::download(new TransactionsExport($transactions), $fileName);
            case 'REVENUE':
                $revenues = $this->reportRepository->getRevenueData($fromDate, $endDate);
                return Excel::download(new RevenuesExport($revenues), $fileName);
            case 'NEW_CUSTOMERS':
                $newCustomers = $this->reportRepository->getNewCustomers($fromDate, $endDate);
                return Excel::download(new NewCustomersExport($newCustomers), $fileName);
            case 'TOP_CUSTOMERS':
                $topCustomers = $this->reportRepository->getTopCustomers($fromDate, $endDate);
                return Excel::download(new TopCustomersExport($topCustomers), $fileName);
            default:
                return redirect()->back()->with('error', 'Judul laporan tidak valid');
        }
    }
}
