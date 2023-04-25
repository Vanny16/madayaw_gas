<?php

namespace App\Exports;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

// class SalesExport implements FromCollection, WithHeadings
class SalesExport implements FromQuery
{
    public function query()
    {
        return DB::table('transactions')
        ->orderBy('trx_datetime');
    }

    public function headings(): array
    {
        return [
            'id',
            'product_id',
            'quantity',
            'amount',
            'trx_datetime',
            'created_at',
            'updated_at',
            'updated_at',
            'updated_at',
            'updated_at',
            'updated_at',
            'updated_at',
            'updated_at',
            'updated_at',
            'updated_at',
        ];
    }
}

?>
