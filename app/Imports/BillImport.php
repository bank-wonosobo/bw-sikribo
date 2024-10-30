<?php

namespace App\Imports;

use App\Models\Bill;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BillImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {

        // dd($row['jatuh_tempo']);
        if ($row['nik'] != null) {
            $bill = Bill::whereDate('due_date', Carbon::createFromFormat('d/m/Y',$row['jatuh_tempo']))
                    ->where('account_number', $row['nomer_rekening'])->first();
            if ($bill == null) {
                $customer = Customer::where('nik', $row['nik'])->first();

                if ($customer === null) {
                    $customer = new Customer();
                    $customer->name = $row['nama'];
                    $customer->nik = $row['nik'];
                    $customer->phone = $row['no_telphone'];
                    $customer->save();
                }

                return Bill::create([
                    'customer_id' => $customer->id,
                    'amount_due' => $row['total_tagihan'],
                    'due_date' => Carbon::createFromFormat('d/m/Y',$row['jatuh_tempo']),
                    'account_number' => $row['nomer_rekening']
                ]);
            }
        }
    }

    public function headingRow(): int
    {
        return 1;
    }
}
