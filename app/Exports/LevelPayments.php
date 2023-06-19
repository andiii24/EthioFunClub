<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;

class LevelPayments implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Payment::all();
    }
}
