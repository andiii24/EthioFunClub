<?php

namespace App\Exports;

use App\Models\Product;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GeneratedSerialNumbers implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::select('id', 'serial_num', 'created_at')
            ->where('status', '0')
            ->get()
            ->map(function ($product) {
                $product->created_at = Carbon::parse($product->created_at)->format('F j, Y');
                return $product;
            });
    }
    public function headings(): array
    {
        return [
            'Id',
            'Serial Number',
            'Created At',
        ];
    }

}
