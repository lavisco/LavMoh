<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class TransactionExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        // this is an example, not exactly like your database structure 
        return Transaction::all();
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->code,
            Date::dateTimeToExcel($row->created_at),
            $row->status,
            $row->total_amount,
            $row->bank_charge,
            $row->platform_charge,
            $row->shop_discount,
            $row->payable_amount,
            $row->cleared_by,
            $row->payment_mode,
            $row->clearance_date,
            $row->request_withdrawal_date,
            $row->order->code,
            $row->user->name,
            $row->user->email,
            $row->user->phone,
        ];
    }

        /**
     * The heading row will be added as very first row of the sheet.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Code',
            'Date created',
            'Status',
            'Total amount',
            'Bank charge',
            'Platform charge',
            'Shop discount',
            'Payable amount',
            'Cleared by',
            'Payment mode',
            'Clearance date',
            'Request withdrawal date',
            'Order Code',
            'User Name',
            'User Email',
            'User Phone',
        ];
    }
}
