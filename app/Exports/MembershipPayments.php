<?php

namespace App\Exports;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MembershipPayments implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $user = Auth::user();

        $sales = Sale::where('user_id', $user->id)
            ->with('user:id,name')
            ->select('id', 'serial_num', 'user_id', 'created_at')
            ->get()
            ->map(function ($sale) {
                $sale->user_name = $sale->user->name;
                $sale->created_at = Carbon::parse($sale->created_at)->format('F j, Y');
                return $sale;
            });

        return $sales;
    }
    public function headings(): array
    {
        return [
            'ID',
            'Serial Number',
            'User Id',
            'Date',
            'User Name',
        ];
    }
}
