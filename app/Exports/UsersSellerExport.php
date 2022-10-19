<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UsersSellerExport implements FromQuery, WithMapping, WithHeadings
{
    public function query()
    {
        return User::query()->where('role_id', 2);
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

        /*
            Date::dateTimeToExcel($row->seller_profile->created_at),
            $row->seller_profile->country,
            $row->seller_profile->province,
            $row->seller_profile->district,
            $row->seller_profile->city,
            $row->seller_profile->address,
            $row->seller_profile->deposit_account,
            $row->seller_profile->deposit_name,
            $row->seller_profile->deposit_bank,
            $row->seller_profile->deposit_bank_branch,
            $row->seller_profile->deposit_account_status,
         */
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
            'Date Signed up',
        ];

        /*
            'Date Setup Profile',
            'Country',
            'Province',
            'District',
            'City',
            'Address',
            'Zipcode',
            'Billing address',
            'Deposit account',
            'Deposit name',
            'Deposit bank',
            'Deposit bank branch',
            'Deposit account status',
        */
    }
}
