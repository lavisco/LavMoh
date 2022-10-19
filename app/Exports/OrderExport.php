<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class OrderExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        // this is an example, not exactly like your database structure 
        return Order::all();
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->code,
            Date::dateTimeToExcel($row->created_at),
            $row->delivery_date,
            $row->recipient_first_name,
            $row->recipient_last_name,
            $row->recipient_email,
            $row->recipient_phone,
            $row->address_line_one,
            $row->address_line_two,
            $row->zipcode,
            $row->city,
            $row->district,
            $row->state,
            $row->country,
            $row->first_name,
            $row->last_name,
            $row->email,
            $row->phone,
            $row->billing_address_line_one,
            $row->billing_address_line_two,
            $row->billing_zipcode,
            $row->billing_city,
            $row->billing_district,
            $row->billing_state,
            $row->billing_country,
            $row->currency_code,
            $row->current_exchange_rate,
            $row->total,
            $row->subtotal,
            $row->tax,
            $row->giftwrap_price,
            $row->shipping_price,
            $row->discount_price,
            $row->order_state->state,
            $row->shop->name,
            $row->seller->name,
            $row->buyer->name,
            $row->shipping->type,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Code',
            'Date created',
            'Delivery Date',    
            'Recipient First name',
            'Recipient Last name',
            'Recipient Email',
            'Recipient Phone',
            'Address line 1',
            'Address line 2',
            'Zipcode',
            'City',
            'District',
            'State',
            'Country',
            'Billing First name',
            'Billing Last name',
            'Billing Email',
            'Billing Phone',
            'Billing address line 1',
            'Billing address line 2',
            'Billing zipcode',
            'Billing city',
            'Billing district',
            'Billing state',
            'Billing country',
            'Currency code',
            'Current exchange rate',
            'Total',
            'Subtotal',
            'Tax',
            'Giftwrap price',
            'Shipping price',
            'Discount price',
            'Status',
            'Shop',
            'Seller',
            'Buyer',
            'Shipping type',
        ];
    }
}
