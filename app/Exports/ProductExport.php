<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProductExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        // this is an example, not exactly like your database structure 
        return Product::all();
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->code,
            Date::dateTimeToExcel($row->created_at),
            $row->title,
            $row->slug,
            $row->short_description,
            $row->base_price,
            $row->processing_time,
            $row->has_custom_text,
            $row->has_variations,
            $row->has_inventory,
            $row->quantity,
            $row->category->name,
            $row->product_state->state,
            $row->user->name,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Code',
            'Date created',
            'Title',
            'Slug',
            'Short description',
            'Base price',
            'Processing time',
            'Has custom text',
            'Has variation',
            'Has inventory',
            'Quantity',
            'Category',
            'State',
            'User',
        ];
    }
}
