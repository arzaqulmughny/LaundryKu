<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.transactions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request) {}

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $transaction = $transaction->load('services');
        return view('pages.transactions.create', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //  
    }

    /**
     * Export invoice
     */
    public function export(Transaction $transaction)
    {
        // Load relation
        $transaction->load('services');

        // return view('pages.transactions.export', compact('transaction'));

        $pdf = Pdf::loadView('pages.transactions.export', [
            'transaction' => $transaction,
        ])->setPaper([0, 0, 58 * 2.83, 200 * 2.83])
            ->setOption('margin-top', 0)
            ->setOption('margin-right', 0)
            ->setOption('margin-bottom', 0)
            ->setOption('margin-left', 0);

        return $pdf->stream("invoice-{$transaction->id}.pdf");
    }
}
