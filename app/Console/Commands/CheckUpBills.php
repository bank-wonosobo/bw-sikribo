<?php

namespace App\Console\Commands;

use App\Models\Bill;
use App\Models\Notification;
use Illuminate\Console\Command;

class CheckUpBills extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bills:check-unpaid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check unpaid bills and send notification if necessary';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $bills = Bill::where('status', 'unpaid')
            ->where('due_date', '<=', now()->addDay(7))
            ->get();

        foreach ($bills as $bill) {
            Notification::create([
               'customer_id' => $bill->customer_id,
               'bill_id' => $bill->id,
               'message' => 'Tagihan anda sebesar Rp. 50.000 akan besakhir pada 12-12-2023',
               'send_date' => now(),
               'channel' => 'whatssapp',
               'status' => 'pending'
            ]);
        }
    }
}
