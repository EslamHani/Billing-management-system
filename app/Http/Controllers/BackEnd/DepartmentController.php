<?php

namespace App\Http\Controllers\BackEnd;

use Image;
use Storage;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BackEnd\Department\Store;
use App\Http\Requests\BackEnd\Department\Update;

class DepartmentController extends Controller
{
    protected $modelName;
    protected $routeName;
    protected $pageName;
    protected $viewName;

    public function __construct(Department $model)
    {
        $this->modelName = $model;
        $this->routeName = "departments";
        $this->pageName  = "Departments";
        $this->viewName  = "backend.departments.";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('departments_list');
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
        $this->authorize('departments_create');
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
        $validatedData = $request->validated();

        $this->modelName->create([
            'department_name' => $validatedData['department_name'],
            'description'      => $validatedData['description'],
            'user_id'          => currentUser()->id,
        ]);

        return redirect()->route($this->routeName.'.index')
                    ->with('success', 'تم اضافة قسم جديد بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('departments_update');
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
        $record = $this->modelName->findOrFail($id);

        $validatedData = $request->validated();

        $record->update($validatedData);

        return redirect()->route($this->routeName.'.index')
                ->with('success', 'تم تعديل القسم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('departments_delete');
        $record = $this->modelName->findOrFail($id);

        $record->delete();

        return redirect()->route($this->routeName.'.index')
                    ->with('success', 'تم حذف القسم بنجاح');
    }


    public function deleteAll(Request $request)
    {
        $this->authorize('departments_delete');
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
