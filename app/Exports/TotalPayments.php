<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TotalPayments implements FromCollection, WithHeadings
{
    public function collection()
    {
        $payments = Payment::with('user:id,name')
            ->select('id', 'amount', 'user_id')
            ->where('status', 1)
            ->get()
            ->map(function ($payment) {
                $payment->user_name = $payment->user->name;
                return $payment;
            });

        $totalPrice = $payments->sum('amount');

        // Add the total price as a separate row in the collection
        $totalRow = [
            'Total Price',
            '',
            $totalPrice,
        ];

        return $payments->concat([$totalRow]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Amount',
            'User Name',
        ];
    }
}
