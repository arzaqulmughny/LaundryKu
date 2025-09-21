<?php

namespace App\Http\Requests;

use App\Models\Transaction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class UpdateTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Add custom validation
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function () {
            $relatedTransaction = Transaction::find(request()->route('transaction'));

            // New pays not allowed to greater than bills
            $currentPaysAmount = (int) $relatedTransaction->total_paid;

            $pays = collect($this->pays);
            $newPays = (int) $pays->whereNull('id')->sum('amount');
            $bills = (int) $relatedTransaction->total;

            if (($currentPaysAmount + $newPays) > $bills) {
                session()->flash('error', 'Pembayaran tidak boleh melebihi jumlah yang ditagihkan!');
            }
        });
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer.id' => 'required',
            'date' => 'required',
            'due_date' => 'required',
            'payment_status' => 'required|numeric',
            'total_paid'     => 'nullable|numeric',
            'pays' => 'nullable|array',
            'pays.*.amount' => 'numeric|min:0',
            'pays.*.date' => 'required|date'
        ];
    }
}
