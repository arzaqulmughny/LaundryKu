<?php

namespace App\Services;

use App\Models\Transaction;

class WhatsappMessageService
{
    public static function generateWhatsappMessage(Transaction $transaction): string
    {

        $customerName   = $transaction->customer->name;
        $orderDate      = $transaction->formmated_date;
        $estimateDate   = $transaction->formatted_due_date;
        $items          = $transaction->services;
        $subtotal       = $transaction->total;
        $discount       = 0;
        $total          = $transaction->total;
        $adminName      = $transaction->admin->name;
        $companyName    = "LaundryKu";
        $companyAddress = "Jl. Contoh No.123, Jakarta";
        $companyPhone   = "xxxxx";

        // format daftar item
        $itemLines = $items->map(function ($item, $i) {
            return ($i + 1) . ". {$item->service_name} - {$item->quantity} {$item->service_unit} x Rp" .
                number_format($item->price, 0, ',', '.') .
                " = Rp" . number_format($item->total, 0, ',', '.');
        })->implode("%0A");

        $message = "
        Halo {$customerName},%0A%0A
        Terima kasih telah memesan layanan {$companyName}.%0A%0A

        Tanggal Pemesanan: {$orderDate}%0A
        Estimasi Selesai: {$estimateDate}%0A%0A

        Daftar Item:%0A{$itemLines}%0A%0A
        Subtotal: Rp" . number_format($subtotal, 0, ',', '.') . "%0A
        Diskon: Rp" . number_format($discount, 0, ',', '.') . "%0A
        Total: Rp" . number_format($total, 0, ',', '.') . "%0A%0A

        Admin: {$adminName}%0A
        - {$companyName}%0A
        Alamat: {$companyAddress}%0A
        Telepon: {$companyPhone}";

        $link = "https://api.whatsapp.com/send?phone={$transaction->customer_phone}&text=" . $message;

        return $link;
    }
}
