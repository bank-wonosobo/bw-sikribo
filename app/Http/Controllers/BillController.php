<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bill\ImportRequest;
use App\Imports\BillImport;
use App\Models\Bill;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BillController extends Controller {
    public function index(Request $request) {
        $yearMonth = $request->get('year_month');
        if ( $yearMonth== null) {
            $yearMonth = Carbon::now()->format("Y-m");
        }

        $month = Carbon::createFromFormat('Y-m', $yearMonth)->month;
        // inisialisasi tahun
        $year = Carbon::createFromFormat('Y-m', $yearMonth)->year;

        $bills = Bill::where('status', 'unpaid')
            ->whereMonth('due_date', $month)
            ->whereYear('due_date', $year)
            ->get();
        return view('admin.bill.index', compact('bills'));
    }

    public function import(ImportRequest $request) {
        try {
            Excel::import(new BillImport(), $request->file('file'));
            return redirect()->back()->with('success', 'Berhasil import data');
        } catch (\Exception $e) {
            return $e;
        }
    }
}
