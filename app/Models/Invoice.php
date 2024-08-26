<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
	use SoftDeletes;

    protected $guarded = [];

    public function order()
    {
    	return $this->belongsTo(Order::class)->with(['products', 'governorate']);
    }

    public static function getInvoice()
    {
    	$records = DB::table('invoices')
		            ->join('orders', 'invoices.order_id', '=', 'orders.id')
		            ->select('orders.order_number', 'orders.client_name', 'orders.client_number1', 'orders.total', 'orders.shipping', 'invoices.shipping_company', 'invoices.payment_status', 'orders.seller_name', 'invoices.created_at')
                    ->whereMonth('invoices.created_at', date('m'))
		            ->get()->toArray();
    	return $records;
    }
}



