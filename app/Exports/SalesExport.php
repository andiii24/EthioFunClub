<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Sale::with('user:id,name')->select('id', 'serial_num', 'user_id')->get()->map(function ($sale) {
            $sale->user_name = $sale->user->name;
            return $sale;
        });
    }
    public function headings(): array
    {
        return [
            'ID',
            'Serial Number',
            'User Id',
            'User Name',
        ];
    }
}
