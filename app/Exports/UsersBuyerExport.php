<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UsersBuyerExport implements FromQuery, WithMapping, WithHeadings
{
    public function query()
    {
        return User::query()->where('role_id', 3);
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->name,
            $row->email,
            $row->phone,
            Date::dateTimeToExcel($row->created_at),
        ];
    }

        /**
     * The heading row will be added as very first row of the sheet.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Date created',
        ];
    }
}
