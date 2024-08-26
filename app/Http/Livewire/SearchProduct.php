<?php

namespace App\Http\Livewire;

use DB;
use App\Models\Order;
use App\Models\User;
use Livewire\Component;
use App\Models\Product;
use App\Notifications\ProductSold;

class SearchProduct extends Component
{
	public $search;
	public $record;
	public $color;
	public $quantity;
	public $discount;
    public $orderId;

    protected $updatesQueryString = [
        'search' => ['except' => ''],
    ];

    public function updated($field)
    {
        $this->validateOnly($field, [
            'color'    => 'required|string',
            'quantity' => 'required|integer',
            'discount' => 'required|integer',
        ]);
    }

    public function mount($record)
    {
    	$this->record = $record;
        $this->orderId = $record->id;
        $this->search = request()->query('search', $this->search);
    }

    public function addProductOrder($productId, $orderId)
    {
    	$validatedData = $this->validate([
	            'color'    => 'required|string',
	            'quantity' => 'required|integer',
	            'discount' => 'required|integer',
	        ]);

        $order   = Order::findOrFail($orderId);
        $product = Product::findOrFail($productId);

        $total = ($product->selling_price)*($validatedData['quantity'])-($validatedData['discount'])*($validatedData['quantity']);

        $order->products()->attach($product->id, ['color' => $validatedData['color'], 'quantity' => $validatedData['quantity'], 'discount' => $validatedData['discount']]);

        $order->update(['total' => $order->total + $total]);

        $stock = $product->stock - $validatedData['quantity'];
        
        $product->update(['stock' => $stock]);
        
        $this->reset(['search', 'color', 'quantity', 'discount']);
        
        if($product->stock <= 2)
        {
            $users = User::where('id', '!=', currentUser()->id)->get();

            foreach($users as $user)
            {
                if($user->abilities()->contains('products_update'))
                {
                    $user->notify(new ProductSold($product));
                }
            }
        }

    }

    public function remove($id)
    {
        $data = DB::table('order_product')->where('id', $id);
        $quantity = $data->value('quantity');
        $product  = $data->value('product_id');
        $order    = $data->value('order_id');
        $discount    = $data->value('discount');
        $data->delete();
        $product = Product::findOrFail($product);
        $order = Order::findOrFail($order);
        $total = ($product->selling_price)*($quantity)-($discount)*($quantity);
        $order->update(['total' => $order->total - $total]);
        $product->update(['stock' => $product->stock + $quantity]);
    }

    

    public function render()
    {
        return view('livewire.search-product', [
        	'product' => Product::where('code', $this->search)->first(),
            'orderDetails' => Order::findOrFail($this->orderId)->products()->get(),
        ]);
    }
}
