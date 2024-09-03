<?php

namespace App\Services;

use App\Http\Requests\Tagihan\SendWhatsappTagihanReq;

interface TagihanService
{
    function sendWhatsapp($whatsappNumber, SendWhatsappTagihanReq $req);
}
