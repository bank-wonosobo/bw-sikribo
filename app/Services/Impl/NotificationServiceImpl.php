<?php

namespace App\Services\Impl;

use App\Models\Bill;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Http;

class NotificationServiceImpl implements NotificationService {
    function sendWhatsapp(array $billId)
    {
        foreach ($billId as $id) {
            $bill = Bill::find($id);
            $name = $bill->customer->name;
            $dueDate = $bill->due_date;
            $amountDue = number_format($bill->amount_due);
            $accountNumber = $bill->account_number;
            $meessage = <<<EOD
            Yth. $name
            Tagihan anda pada rekening $accountNumber sebesar Rp. $amountDue telah jatuh tempo pada $dueDate,
            Mohon segera dilunasi ya qutie... Lopyu
            EOD;
            $this->send($bill->customer->phone, $meessage);
        }
    }

    function send($target, $message) {
        $reqUrl = "https://api.fonnte.com/send";
        $res = Http::withHeaders([
            "Authorization" => "hCvMYyo3RA67ZGgAkDMz",
        ])->post($reqUrl, [
            "target" => $target,
            "message" => $message,
            "countryCode" => "62"
        ]);
    }
}
