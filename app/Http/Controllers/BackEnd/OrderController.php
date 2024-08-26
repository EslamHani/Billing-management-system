<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\InvoiceReceived;
use App\Http\Requests\BackEnd\Order\Store;
use App\Http\Requests\BackEnd\Order\Update;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    protected $modelName;
    protected $routeName;
    protected $pageName;
    protected $viewName;

    public function __construct(Order $model)
    {
        $this->modelName = $model;
        $this->routeName = "orders";
        $this->pageName  = "Orders";
        $this->viewName  = "backend.orders.";
    }


    public function append()
    {
        $array = [
            'governorates' => Governorate::all(),
        ];

        return $array;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('orders_list');
        $records = $this->modelName->WhereNotNull('client_name')
                    ->orderBy('id', 'desc')
                    ->get();
        
        return view($this->viewName.'index', [
            'pageName'  => $this->pageName,
            'routeName' => $this->routeName,
            'records'   => $records,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('orders_create');
        $latest_order = $this->modelName->latest()->first();
        if(!is_null($latest_order)){
            if(is_null($latest_order->client_name))
            {
                $latest_order->delete();
                $latest_order = $this->modelName->latest()->first();
                if(!is_null($latest_order))
                {
                    $order_number = $latest_order->order_number + 1;
                }else{
                    $order_number = 1;
                }
            }else{
                $order_number = $latest_order->order_number + 1;
            }
        }else{
             $order_number = 1;
        }
        $record = $this->modelName->create([
            'order_number' => $order_number,
            'seller_name' => currentUser()->name
        ]);
        $append = $this->append();
        return view($this->viewName.'create', [
            'pageName'  => $this->pageName,
            'routeName' => $this->routeName,
            'viewName'  => $this->viewName,
            'record'    => $record,
        ])->with($append);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $this->authorize('orders_create');
        $record = $this->modelName->findOrFail(request('id'));

        $validatedData = $request->validated();
        
        $record->update([
            'order_number' => $validatedData['order_number'],
            'client_name' => $validatedData['client_name'],
            'client_number1' => $validatedData['client_number1'],
            'client_number2' => $validatedData['client_number2'],
            'client_address' => $validatedData['client_address'],
            'client_username' => $validatedData['client_username'],
            'seller_name' => $validatedData['seller_name'],
            'shipping' => $validatedData['shipping'],
            'governorate_id' => $validatedData['governorate_id'],
            'note' => $validatedData['note'],
            'status' => $validatedData['status'],
            'plateform' => $validatedData['plateform'],
        ]);

        $users = User::where('id', '!=', currentUser()->id)->get();

        foreach($users as $user)
        {
            if($user->abilities()->contains('orders_update'))
            {
                Notification::send($user, new InvoiceReceived(currentUser(), $record->id));
            }
        }

        $this->createInvoice($record->id, $validatedData['status']);
        
        return redirect()->route($this->routeName.'.index')
            ->with('success', 'تم اضافة الاوردر بنجاح');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('orders_update');
        $record = $this->modelName->findOrFail($id);
        $append = $this->append();
        // mark as read unread notifications
        foreach(currentUser()->unreadNotifications as $notification){
            if($notification->type === 'App\Notifications\InvoiceReceived')
            {
                if($notification->data['record'] == $id)
                {
                    $notification->markAsRead();
                }
            }
        }
        return view($this->viewName.'edit', [
            'pageName'  => $this->pageName,
            'routeName' => $this->routeName,
            'viewName'  => $this->viewName,
            'record'    => $record,
        ])->with($append);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, $id)
    {
        $this->authorize('orders_update');
        $record = $this->modelName->findOrFail($id);

        $validatedData = $request->validated();

        $record->update([
            'order_number' => $validatedData['order_number'],
            'client_name' => $validatedData['client_name'],
            'client_number1' => $validatedData['client_number1'],
            'client_number2' => $validatedData['client_number2'],
            'client_address' => $validatedData['client_address'],
            'client_username' => $validatedData['client_username'],
            'seller_name' => $validatedData['seller_name'],
            'shipping' => $validatedData['shipping'],
            'governorate_id' => $validatedData['governorate_id'],
            'note' => $validatedData['note'],
            'status' => $validatedData['status'],
            'plateform' => $validatedData['plateform'],
        ]);



        $this->createInvoice($record->id, $validatedData['status']);
        
        return redirect()->route($this->routeName.'.index')
                ->with('success', 'تم تعديل المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('orders_delete');
        $record = $this->modelName->findOrFail($id);

       // dd($record->products);

        foreach($record->products as $product)
        {
            $quantity = $product->pivot->quantity;
            $product = Product::findOrFail($product->id);
            $product->update(['stock' => $product->stock + $quantity]);
        }


        $record->delete();
        return redirect()->route($this->routeName.'.index')
                    ->with('success', 'تم حذف العلامة التجارية بنجاح');
    }


    public function deleteAll(Request $request)
    {
        $this->authorize('orders_delete');
        $ids = $request->ids;
        $count = count($ids);
        foreach($ids as $id)
        {
            $record = $this->modelName->findOrFail($id);
            foreach($record->products as $product)
            {
                $quantity = $product->pivot->quantity;
                $product = Product::findOrFail($product->id);
                $product->update(['stock' => $product->stock + $quantity]);
            }

            $record->delete();
        }
         return redirect()->route($this->routeName.'.index')
                    ->with('success', 'تم حذف '.$count.' من السجلات بنجاح');
    }

    public function createInvoice($orderId, $status)
    {
        if($status === "approved")
        {
            Invoice::create([
                'order_id' => $orderId,
            ]);
        }
    }
}