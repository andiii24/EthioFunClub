<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::select('name', 'phone', 'level')
            ->where('role', 'customer')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Phone',
            'Level',
        ];
    }

}
