<?php

namespace App\Livewire\Pages\Transactions;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\TransactionService;
use App\Repositories\TransactionRepository;
use App\Services\WhatsappMessageService;
use Exception;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public string $pageTitle, $pageSubtitle;

    public $date, $due_date, $payment_status = 1, $total_paid = 0, $services = [], $id = null, $status, $pays = [];
    public ?Customer $customer;
    public ?Transaction $transaction;

    public $statusEnums = [];

    public function mount()
    {
        $transaction = request()->route('transaction');

        if (!empty($transaction)) {
            $transaction->load(['services', 'pays']);

            $this->id = $transaction->id;
            $this->status = $transaction->status;
            $this->date = $transaction->date;
            $this->customer = $transaction->customer;
            $this->due_date = $transaction->due_date;
            $this->payment_status = $transaction->payment_status;
            $this->total_paid = $transaction->payment_status == 1 ? $transaction->pays()->first()->amount : $transaction->total_paid;
            $this->services = $transaction->services->map(function (TransactionService $service) {
                return array_merge([
                    'id' => $service->id
                ], $this->getServiceArray($service));
            });

            $this->transaction = $transaction;
            $this->pageTitle = 'Edit Data Transaksi';
            $this->pageSubtitle = 'Kelola data transaksi di sini';
            $this->pays = $transaction->pays->map(function ($pay) {
                return [
                    'id' => $pay->id,
                    'amount' => $pay->amount,
                    'admin' => $pay->admin->name,
                    'date' => $pay->date,
                ];
            })->toArray();
        } else {
            $this->pageTitle = 'Tambah Data Transaksi';
            $this->pageSubtitle = 'Masukkan data transaksi di sini';
            $this->date = date('Y-m-d');
        }

        $this->statusEnums = Transaction::$statusEnums;
    }

    public function getServiceArray(Service | TransactionService $service)
    {
        $result = [];

        if ($service instanceof Service) {
            $result = [
                'service_id' => $service->id,
                'service_name' => $service->name,
                'service_unit' => $service->unit,
                'service_price' => $service->price,
                'quantity' => 1,
                'total' => 1,
            ];
        } else {
            $result = [
                'id' => $service->id,
                'service_id' => $service->service_id,
                'service_name' => $service->service_name,
                'service_unit' => $service->service_unit,
                'service_price' => $service->service_price,
                'quantity' => $service->quantity,
                'total' => $service->total,
            ];
        }

        return $result;
    }

    public function getTotal()
    {
        return collect($this->services)->sum(function ($service) {
            return (int) $service['service_price'] * (int) $service['quantity'];
        });
    }

    /**
     * Get formatted total in Rupiah currency
     */
    public function getFormattedTotal(): string
    {
        $formatter = new \NumberFormatter('id_ID', \NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->getTotal(), 'IDR');
    }

    #[On('select-service')]
    public function selectService($id)
    {
        $service = Service::find($id);

        $this->services[] = $this->getServiceArray($service);

        $this->dispatch('hide-add-service-modal');
    }

    #[On('select-customer')]
    public function selectCustomer($id)
    {
        $customer = Customer::find($id);
        $this->customer = $customer;
    }

    public function clearCustomer()
    {
        $this->customer = null;
    }

    #[On('delete-service')]
    public function deleteService($selectedIndex)
    {
        $this->services = collect($this->services)->filter(function ($service, $index) use ($selectedIndex) {
            return $index != $selectedIndex;
        })->toArray();
    }

    #[On('update-quantity')]
    public function updateQuantity($selectedIndex, $newQuantity)
    {
        $this->services[$selectedIndex]['quantity'] = $newQuantity;
        $this->services[$selectedIndex]['total'] = $this->services[$selectedIndex]['service_price'] * $newQuantity;
    }

    public function getWhatsappMessageLink()
    {
        if (empty($this->id)) {
            return "";
        }

        return WhatsappMessageService::generateWhatsappMessage($this->transaction);
    }

    /**
     * Clear all user input
     */
    public function resetForm()
    {
        $this->reset([
            'customer',
            'date',
            'due_date',
            'payment_status',
            'services',
        ]);
    }

    /**
     * Submit the form
     */
    public function submit()
    {
        if (empty($this->services)) {
            $this->dispatch('show-alert', [
                'message' => 'Pilih layanan terlebih dahulu'
            ]);
        }
        
        if (empty($this->id)) {
            $this->validate((new StoreTransactionRequest())->rules());
            $this->store();
        } else {
            $this->validate((new UpdateTransactionRequest())->rules());
            $this->update();
        }
    }

    /**
     * Add pay
     */
    #[On('add-pay')]
    public function addPay($date, $amount)
    {
        $this->pays[] = [
            'id' => null,
            'date' => $date,
            'amount' => $amount
        ];
    }

    /**
     * Delete pay
     */
    #[On('delete-pay')]
    public function deletePay($selectedIndex)
    {
        $this->pays = collect($this->pays)->filter(fn ($row, $index) => $index != $selectedIndex)->toArray();
    }

    public function store()
    {
        try {
            // Store header
            $transaction = TransactionRepository::store([
                'customer_id' => $this->customer->id,
                'date' => $this->date,
                'due_date' => $this->due_date,
                'payment_status' => $this->payment_status,
                'total_paid' => $this->total_paid ?? 0,
                'total' => $this->getTotal(),
                'services' => $this->services
            ]);

            // Store services
            TransactionRepository::upsertServices($transaction, $this->services);
            return redirect()->route('transactions.index');
        } catch (Exception $exception) {
            // Send error session
            $this->dispatch('show-alert', [
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function update()
    {
        try {
            // Store header
            $transaction = Transaction::find($this->id);
            
            $transaction->update([
                'customer_id' => $this->customer->id,
                'date' => $this->date,
                'due_date' => $this->due_date,
                'payment_status' => $this->payment_status,
                'total_paid' => $this->total_paid ?? 0,
                'total' => $this->getTotal(),
                'status' => $this->status
            ]);

            TransactionRepository::storePays($transaction->fresh(), $this->pays);

            return redirect()->route('transactions.index');
        } catch (Exception $exception) {
            // Send error session
            $this->dispatch('show-alert', [
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.pages.transactions.create');
    }
}
