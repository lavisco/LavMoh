<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UsersExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        // this is an example, not exactly like your database structure 
        return User::all();
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->name,
            $row->email,
            $row->phone,
            $row->role->name,
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
            'Role',
            'Date created',
        ];
    }
}