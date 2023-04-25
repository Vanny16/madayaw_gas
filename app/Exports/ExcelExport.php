<?php

namespace App\Exports;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExport implements FromQuery, WithHeadings
{
    protected $functionName;

    public function __construct($functionName)
    {
        $this->functionName = $functionName;
    }

    public function query()
    {
        return $this->{$this->functionName}();
    }

    public function salesExport()
    {
        return DB::table('transactions')
                ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
                ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                ->join('purchases', 'purchases.trx_id', '=', 'transactions.trx_id')
                ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
                ->orderBy('transactions.trx_datetime', 'DESC');
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
