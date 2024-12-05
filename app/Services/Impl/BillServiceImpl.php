<?php

namespace App\Services\Impl;

use App\Models\Bill;
use App\Services\BillService;
use Illuminate\Support\Facades\Http;

class BillServiceImpl implements BillService {
    function sendAllWhatsapp()
    {
        $bills = Bill::where("status", "unpaid")->get();

        foreach ($bills as $bill) {
            $meessage = <<<EOD
            Asslamualaikum cantik
            $bill->customer->name is replaced automatically.
            EOD;
            $this->send($bill->phone, $meessage);
        }
    }

    function send($target, $message) {
        $reqUrl = "https://api.fonnte.com/send";
        $res = Http::withHeaders([
            "Authorization" => "@cbpg@@SEQiHwme6fZVc",
        ])->post($reqUrl, [
            "target" => $target,
            "message" => $message,
            "countryCode" => "62"
        ]);
    }
}
