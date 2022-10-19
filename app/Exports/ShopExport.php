<?php

namespace App\Exports;

use App\Models\Shop;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ShopExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        // this is an example, not exactly like your database structure 
        return Shop::all();
    }

    public function map($row): array
    {
        // row will be the shop and user->cities will be the relationship
        $cities = array();
        foreach ($row->user->cities as $city) {
            $cities[] = $city->name;
        }
        
        return [
            $row->id,
            $row->name,
            Date::dateTimeToExcel($row->created_at),
            $row->slug,
            $row->about,
            $row->country,
            $row->province,
            $row->district,
            $row->city,
            $row->address,
            $row->zipcode,
            $row->status,
            $row->user->name,
            $row->user->phone,
            $row->user->email,
            implode(", ",$cities)
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Date created',
            'Slug',
            'About',
            'Country',
            'Province',
            'District',
            'City',
            'Address',
            'Zipcode',
            'Status',
            'User name',
            'User phone',
            'User email',
            'Cities',
        ];
    }
}
