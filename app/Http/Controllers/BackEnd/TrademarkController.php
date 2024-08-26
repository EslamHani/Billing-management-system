<?php

namespace App\Http\Controllers\BackEnd;

use Image;
use Storage;
use App\Models\Trademark;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BackEnd\Trademark\Store;
use App\Http\Requests\BackEnd\Trademark\Update;

class TrademarkController extends Controller
{
    protected $modelName;
    protected $routeName;
    protected $pageName;
    protected $viewName;

    public function __construct(Trademark $model)
    {
        $this->modelName = $model;
        $this->routeName = "trademarks";
        $this->pageName  = "Trademarks";
        $this->viewName  = "backend.trademarks.";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('trademarks_list');
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
        $this->authorize('trademarks_create');
        return view($this->viewName.'create', [
            'pageName'  => $this->pageName,
            'routeName' => $this->routeName,
            'viewName'  => $this->viewName,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $this->authorize('trademarks_create');
        $validatedData = $request->validated();

        if($request->hasFile('logo'))
        {
            Image::make($request->logo)->resize(350, null, function($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/trademarks/'. $request->logo->hashName()));

            $validatedData['logo'] = "/uploads/trademarks/".$request->logo->hashName();
        }

        $this->modelName->create($validatedData);

        return redirect()->route($this->routeName.'.index')->with('success', 'تم اضافة علامة تجارية جديده');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('trademarks_update');
        $record = $this->modelName->findOrFail($id);

        return view($this->viewName.'edit', [
            'pageName'  => $this->pageName,
            'routeName' => $this->routeName,
            'viewName'  => $this->viewName,
            'record'    => $record,
        ]);
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
        $this->authorize('trademarks.update');
        $record = $this->modelName->findOrFail($id);

        $validatedData = $request->validated();

        if($request->hasFile('logo'))
        {
            Storage::delete($record->logo);

            Image::make($request->logo)->resize(350, null, function($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/trademarks/'. $request->logo->hashName()));

            $validatedData['logo'] = "/uploads/trademarks/".$request->logo->hashName();
        }

        $record->update($validatedData);

        return redirect()->route($this->routeName.'.index')
                ->with('success', 'تم تعديل العلامة التجارية بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('trademarks_delete');
        $record = $this->modelName->findOrFail($id);

        if(!is_null($record->logo))
        {
            Storage::delete($record->logo);
        }

        $record->delete();

        return redirect()->route($this->routeName.'.index')
                    ->with('success', 'تم حذف العلامة التجارية بنجاح');
    }


    public function deleteAll(Request $request)
    {
        $this->authorize('trademarks_delete');
        $ids = $request->ids;
        $count = count($ids);
        foreach($ids as $id)
        {
            $record = $this->modelName->findOrFail($id);

            if(!is_null($record->logo))
            {
                Storage::delete($record->logo);
            }
            $record->delete();
        }
         return redirect()->route($this->routeName.'.index')
                    ->with('success', 'تم حذف '.$count.' من السجلات بنجاح');
    }
}
