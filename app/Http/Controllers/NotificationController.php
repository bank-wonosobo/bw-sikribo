<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notifications\SendNotificationReq;
use App\Models\Bill;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    private NotificationService $notificationService;

    public function __construct(NotificationService $notificationService) {
        $this->notificationService = $notificationService;
    }

    public function index() {
        // $bills = Bill::where('status', 'unpaid')
        //     ->whereDate('due_date', '<=', Carbon::now())
        //     ->get();
        $bills = Bill::where('status', 'unpaid')
            ->get();
        return view('admin.notification.index', compact('bills'));
    }

    public function send(SendNotificationReq $req) {
        try {
            $this->notificationService->sendWhatsapp($req->input('bill_ids'));
            return redirect()->back()->with("success", "Berhasil send notifikasi");
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with("success", "Terjadi masalah : " . $e->getMessage());
        }
    }
}
