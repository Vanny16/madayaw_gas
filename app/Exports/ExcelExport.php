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
    protected $functionQuery;
    protected $functionHeading;
    protected $dateFrom;
    protected $dateTo;

    public function __construct($functionQuery, $functionHeading, $dateFrom, $dateTo)
    {
        $this->functionQuery = $functionQuery;
        $this->functionHeading = $functionHeading;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }

    public function query()
    {
        return $this->{$this->functionQuery}();
    }

    public function headings(): array
    {
        return $this->{$this->functionHeading}();
    }

    //FILE FORMATS
    //SALES
    public function salesHeader(){
        return [
            'PURCHASE_ID',
            'TRANSACTION_ID',
            'REFERENCE ID',
            'DATE',
            'TIME',
            'ITEM',
            'TOTAL IN',
            'TOTAL OUT',
            'NET SALES',
            'CASHIER',
            'CUSTOMER',
            'CUSTOMER_ADDRESS',
            'CUSTOMER_CONTACT',
            'CUSTOMER_STATUS',
        ];
    }

    public function salesExport()
    {
        return DB::table('transactions')
                ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
                ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                ->join('purchases', 'purchases.trx_id', '=', 'transactions.trx_id')
                ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
                ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($this->dateFrom)), date("Y-m-d", strtotime($this->dateTo))])
                ->select(
                    'purchases.pur_id',
                    'transactions.trx_id',
                    'transactions.trx_ref_id',
                    'transactions.trx_date',
                    'transactions.trx_time',
                    'products.prd_name',
                    DB::raw('SUM((purchases.pur_crate_in * 12) + purchases.pur_loose_in) as pur_qty_in'),
                    DB::raw('SUM(purchases.pur_qty) as pur_qty_out'), 
                    DB::raw('SUM(purchases.pur_total) as pur_total'),
                    'users.usr_full_name',
                    'customers.cus_name',
                    'customers.cus_address',
                    'customers.cus_contact',
                    'customers.cus_active',
                )
                ->groupBy(
                    'purchases.pur_id',
                    'transactions.trx_id',
                    'transactions.trx_ref_id',
                    'transactions.trx_date',
                    'transactions.trx_time',
                    'transactions.trx_datetime',
                    'products.prd_name',
                    'transactions.trx_total',
                    'users.usr_full_name',
                    'customers.cus_name',
                    'customers.cus_address',
                    'customers.cus_contact',
                    'customers.cus_active'
                )
                ->orderBy('transactions.trx_datetime', 'DESC');
    }
    
    //TRANSACTIONS
    public function transactionsHeader(){
        return [
            'PURCHASE_ID',
            'TRANSACTION_ID',
            'REFERENCE ID',
            'DATE',
            'TIME',
            'ITEM (IN)',
            'TOTAL IN',
            'TOTAL OUT',
            'CASHIER',
            'CUSTOMER',
            'CUSTOMER_ADDRESS',
            'CUSTOMER_CONTACT',
            'CUSTOMER_STATUS',
        ];
    }

    public function transactionsExport()
    {
        return DB::table('transactions')
                ->leftJoin('users', 'users.usr_id', '=', 'transactions.usr_id')
                ->leftJoin('customers', 'customers.cus_id', '=', 'transactions.cus_id')
                ->join('purchases', 'purchases.trx_id', '=', 'transactions.trx_id')
                ->join('products', 'products.prd_id', '=', 'purchases.prd_id')
                ->where('trx_active','=','1')
                ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($this->dateFrom)), date("Y-m-d", strtotime($this->dateTo))])
                ->select(
                    'purchases.pur_id AS ID',
                    'transactions.trx_id',
                    'transactions.trx_ref_id',
                    'transactions.trx_date',
                    'transactions.trx_time',
                    'products.prd_name',
                    DB::raw('SUM((purchases.pur_crate_in * 12) + purchases.pur_loose_in) as pur_qty_in'),
                    DB::raw('SUM(purchases.pur_qty) as pur_qty_out'), 
                    'users.usr_full_name',
                    'customers.cus_name',
                    'customers.cus_address',
                    'customers.cus_contact',
                    'customers.cus_active',
                )
                ->groupBy(
                    'purchases.pur_id',
                    'transactions.trx_id',
                    'transactions.trx_ref_id',
                    'transactions.trx_date',
                    'transactions.trx_time',
                    'transactions.trx_datetime',
                    'products.prd_name',
                    'transactions.trx_total',
                    'users.usr_full_name',
                    'customers.cus_name',
                    'customers.cus_address',
                    'customers.cus_contact',
                    'customers.cus_active'
                )
                ->orderBy('transactions.trx_datetime', 'DESC');
    }

    //SALES
    public function paymentsHeader(){
        return [
            'PMNT ID',
            'PMNT REFERENCE ID',
            'TRX REFERENCE ID',
            'DATE',
            'TIME',
            'AMOUNT RECEIVED',
            'AMOUNT PAID',
            'CHANGE',
            'M.O.P.',
            'CHECK #',
            'CHECK DATE',
            'CASHIER',
            'CUSTOMER',
            'CUSTOMER_ADDRESS',
            'CUSTOMER_CONTACT',
            'CUSTOMER_STATUS',
        ];
    }

    public function paymentsExport()
    {
        return DB::table('payments')
        ->join('transactions', 'transactions.trx_id', '=', 'payments.trx_id')
        ->join('payment_types', 'payment_types.mode_of_payment', '=', 'payments.trx_mode_of_payment')
        ->join('customers', 'customers.cus_id', '=', 'transactions.cus_id')
        ->join('users', 'users.usr_id', '=', 'payments.usr_id')
        ->whereBetween('transactions.trx_date', [date("Y-m-d", strtotime($this->dateFrom)), date("Y-m-d", strtotime($this->dateTo))])
        ->select(
            'payments.pmnt_id',
            'payments.pmnt_ref_id',
            'transactions.trx_ref_id',
            'payments.pmnt_date',
            'payments.pmnt_time',
            'payments.pmnt_received',
            'payments.pmnt_amount',
            'payments.pmnt_change',
            'payments.trx_mode_of_payment',
            'payments.pmnt_check_no',
            'payments.pmnt_check_date',
            'users.usr_full_name',
            'customers.cus_name',
            'customers.cus_address',
            'customers.cus_contact',
            'customers.cus_active',
        )
        ->groupBy(
            'payments.pmnt_id',
            'payments.pmnt_ref_id',
            'transactions.trx_ref_id',
            'payments.pmnt_date',
            'payments.pmnt_time',
            'payments.pmnt_received',
            'payments.pmnt_amount',
            'payments.pmnt_change',
            'payments.trx_mode_of_payment',
            'payments.pmnt_check_no',
            'payments.pmnt_check_date',
            'users.usr_full_name',
            'customers.cus_name',
            'customers.cus_address',
            'customers.cus_contact',
            'customers.cus_active',
        )
        ->orderBy('payments.pmnt_id', 'DESC');
    
    }
}

?>
