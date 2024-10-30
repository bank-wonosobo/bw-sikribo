<?php

namespace App\Services;

interface NotificationService
{
    function sendWhatsapp(array $billId);
}
