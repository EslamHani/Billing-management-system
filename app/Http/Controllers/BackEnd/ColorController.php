<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Requests\BackEnd\Color\Store;
use App\Http\Requests\BackEnd\Color\Update;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    protected $modelName;
    protected $routeName;
    protected $pageName;
    protected $viewName;

    public function __construct(Color $model)
    {
        $this->modelName = $model;
        $this->routeName = "colors";
        $this->pageName  = "Colors";
        $this->viewName  = "backend.colors.";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('colors_list');
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
        $this->authorize('colors_create');
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
        $this->authorize('colors_create');
        $validatedData = $request->validated();

        $this->modelName->create($validatedData);

        return redirect()->route($this->routeName.'.index')
                    ->with('success', 'تم اضافة اللون بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('colors_update');
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
        $this->authorize('colors_update');
        $record = $this->modelName->findOrFail($id);

        $validatedData = $request->validated();

        $record->update($validatedData);

        return redirect()->route($this->routeName.'.index')
                ->with('success', 'تم تعديل اللون بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('colors_delete');
        $record = $this->modelName->findOrFail($id);

        $record->delete();

        return redirect()->route($this->routeName.'.index')
                    ->with('success', 'تم حذف اللون بنجاح');
    }


    public function deleteAll(Request $request)
    {
        $this->authorize('colors_delete');
        $ids = $request->ids;
        $count = count($ids);
        foreach($ids as $id)
        {
            $record = $this->modelName->findOrFail($id);

            $record->delete();
        }
         return redirect()->route($this->routeName.'.index')
                    ->with('success', 'تم حذف '.$count.' من السجلات بنجاح');
    }
}
