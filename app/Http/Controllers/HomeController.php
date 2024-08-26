<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Order;
use App\Models\Invoice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ordersHighChart = $this->ordersHighChart();

        $invoiceBarChart = $this->invoiceBarChart();

        $orderStatusPie  = $this->orderStatusPie();

        $invoiceStatusPie = $this->invoiceStatusPie();

        return view('home', compact('ordersHighChart', 'invoiceBarChart', 'orderStatusPie', 'invoiceStatusPie'));
    }

    // Get count all orders in This Yaer
    public function ordersHighChart()
    {
        $orders = Order::select(DB::raw("COUNT(*) as count"))
                        ->whereYear('created_at', date('Y'))
                        ->groupBy(DB::raw('Month(created_at)'))
                        ->pluck('count');

        $months = Order::select(DB::raw("Month(created_at) as month"))
                        ->whereYear('created_at', date('Y'))
                        ->groupBy(DB::raw('Month(created_at)'))
                        ->pluck('month');

        $datas = array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach($months as $index => $month)
        {
            $datas[$month-1] = $orders[$index];
        }

        return $datas;
    }

    // Get count orders group by status
    public function orderStatusPie()
    {
        $approvedorders = Order::select(DB::raw("COUNT(*) as count"))
                                ->whereYear('created_at', date('Y'))
                                ->where('status', 'approved')
                                ->pluck('count');

        $penddingorders = Order::select(DB::raw("COUNT(*) as count"))
                                ->whereYear('created_at', date('Y'))
                                ->where('status', 'pendding')
                                ->pluck('count');

        $refusedorders = Order::select(DB::raw("COUNT(*) as count"))
                                ->whereYear('created_at', date('Y'))
                                ->where('status', 'refused')
                                ->pluck('count');

        $datas = array($approvedorders[0],$penddingorders[0],$refusedorders[0]);

        return $datas;
    }

    // Get Count invoices in this year
    public function invoiceBarChart()
    {
        $invoices = Invoice::select(DB::raw("COUNT(*) as count"))
                            ->whereYear('created_at', date('Y'))
                            ->groupBy(DB::raw("Month(created_at)"))
                            ->pluck('count');

        $months = Invoice::select(DB::raw("Month(created_at) as month"))
                            ->whereYear('created_at', date('Y'))
                            ->groupBy(DB::raw("Month(created_at)"))
                            ->pluck('month');

        $datas = array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach($months as $index => $month)
        {
            $datas[$month-1] = $invoices[$index];
        }

        return $datas;
    }


    // Get count  group by payment_status
    public function invoiceStatusPie()
    {
        $paidInvoice   = Invoice::select(DB::raw("COUNT(*) as count"))
                                ->whereYear('created_at', date('Y'))
                                ->where('payment_status', 'paid')
                                ->pluck('count');

        $unpaidInvoice = Invoice::select(DB::raw("COUNT(*) as count"))
                                ->whereYear('created_at', date('Y'))
                                ->where('payment_status', 'unpaid')
                                ->pluck('count');

        $datas = array($paidInvoice[0],$unpaidInvoice[0]);

        return $datas;
    }

}
