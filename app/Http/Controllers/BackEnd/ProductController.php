<?php

namespace App\Http\Controllers\BackEnd;

use Image;
use Storage;
use App\Models\Product;
use App\Models\Department;
use App\Models\Trademark;
use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BackEnd\Product\Store;
use App\Http\Requests\BackEnd\Product\Update;

class ProductController extends Controller
{
    protected $modelName;
    protected $routeName;
    protected $pageName;
    protected $viewName;

    public function __construct(Product $model)
    {
        $this->modelName = $model;
        $this->routeName = "products";
        $this->pageName  = "Products";
        $this->viewName  = "backend.products.";
    }


    public function append()
    {
        $array = [
            'departments' => Department::all(),
            'colors'      => Color::all(),
            'trademarks'  => Trademark::all(),
            'selectedColors'    => [],  
            'selectedFiles'     => [],   
        ];

        if(request()->route()->parameter('product'))
        {
            $product_id = request()->route()->parameter('product');
            $array['selectedColors'] = $this->modelName->findOrFail($product_id)->colors()->get()->pluck('id')->toArray();
        }

        return $array;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('products_list');
        $records = $this->modelName->orderBy('id', 'desc')->get();
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
        $this->authorize('products_create');
        $append = $this->append();
        return view($this->viewName.'create', [
            'pageName'  => $this->pageName,
            'routeName' => $this->routeName,
            'viewName'  => $this->viewName,
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
        $validatedData = $request->validated();

        unset($validatedData['images']);
        unset($validatedData['colors']);

        if($request->hasFile('photo'))
        {
            Image::make($request->photo)->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/products/'.$request->photo->hashName()));

            $validatedData['photo'] = "uploads/products/".$request->photo->hashName();
        }  
        
        $record = $this->modelName->create($validatedData);

        if($request->colors){
            $record->colors()->sync($request->colors);
        }
        
        return redirect()->route($this->routeName.'.index')
            ->with('success', 'تم اضافة المنتج بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('products_update');

        $record = $this->modelName->findOrFail($id);
        $append = $this->append();

        // mark as read unread notifications
        foreach(currentUser()->unreadNotifications as $notification){
            if($notification->type === 'App\Notifications\ProductSold')
            {
                if($notification->data['product']['id'] == $id)
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
        $record = $this->modelName->findOrFail($id);

        $validatedData = $request->except(['images', 'colors']);

        if($request->hasFile('photo'))
        {

            Storage::delete($record->photo);

            Image::make($request->photo)->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/products/'.$request->photo->hashName()));

            $validatedData['photo'] = "uploads/products/".$request->photo->hashName();
        }

        $record->update($validatedData);
        
        if($request->colors){
            $record->colors()->sync($request->colors);
        }
        
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
        $this->authorize('products_delete');

        $record = $this->modelName->findOrFail($id);

        if(!is_null($record->photo))
        {
            Storage::delete($record->photo);
        }
        $record->delete();
        return redirect()->route($this->routeName.'.index')
                    ->with('success', 'تم حذف العلامة التجارية بنجاح');
    }


    public function deleteAll(Request $request)
    {
        $this->authorize('products_delete');

        $ids = $request->ids;
        $count = count($ids);
        foreach($ids as $id)
        {
            $record = $this->modelName->findOrFail($id);

             if(!is_null($record->photo))
            {
                Storage::delete($record->photo);
            }
            $record->delete();
        }
         return redirect()->route($this->routeName.'.index')
                    ->with('success', 'تم حذف '.$count.' من السجلات بنجاح');
    }
}
