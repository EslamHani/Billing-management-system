<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Role;
use App\Models\Ability;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    protected $modelName;
    protected $routeName;
    protected $pageName;
    protected $viewName;

    public function __construct(Role $model)
    {
        $this->modelName = $model;
        $this->routeName = "roles";
        $this->pageName  = "Roles";
        $this->viewName  = "backend.roles.";
    }

    
    public function append()
    {
        $array = [
            'abilities' => Ability::all(),
            'selectedAbility' => [],
        ];

        if(request()->route()->parameter('role')){
            $role_id = request()->route()->parameter('role');
            $array['selectedAbility'] = $this->modelName->findOrFail($role_id)
                                        ->abilities()->get()->pluck('id')->toArray();
        }

        return $array;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('roles_list');
        $records = $this->modelName->latest()->get();
        return view($this->viewName.'index', [
            'records'   => $records,
            'routeName'  => $this->routeName, 
            'pageName' => $this->pageName,
            'viewName'  => $this->viewName,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('roles_create');
        $append = $this->append();
        return view($this->viewName.'create', [
            'routeName'  => $this->routeName, 
            'pageName' => $this->pageName,
            'viewName'  => $this->viewName,
        ])->with($append);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('roles_create');
        $validatedData = $request->validate([
            'name'      => ['required', 'string', 'unique:roles'],
            'label'     => ['nullable', 'string', 'min:10'],
            'abilities' => ['required', 'exists:abilities,id', 'min:1']
        ]);

        unset($validatedData['abilities']);
        $record = $this->modelName->create($validatedData);

        
        $record->allowTo($request->abilities);

        return redirect()->route($this->routeName.'.index')
                        ->with('success', 'تمت الاضافة بنجاح');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('roles_update');
        $record = $this->modelName->findOrFail($id);
        $append = $this->append();
        return view($this->viewName.'edit', [
            'record'    => $record,
            'routeName' => $this->routeName, 
            'pageName'  => $this->pageName,
            'viewName'  => $this->viewName,
        ])->with($append);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('roles_update');
        $record = $this->modelName->findOrFail($id);
        
        $validatedData = $request->validate([
            'name'      => ['required', 'string', 'unique:roles,id,'.$record->id],
            'label'     => ['nullable', 'string', 'min:10'],
            'abilities' => ['required', 'exists:abilities,id']
        ]);

        unset($validatedData['abilities']);
        $record->update($validatedData);

        $record->allowTo($request->abilities);

        return redirect()->route($this->routeName.'.index')
                        ->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('roles_delete');
        $record = $this->modelName->findOrFail($id);
        
        $record->delete();

        return redirect()->route($this->routeName.'.index')
                        ->with('success', 'تم الحذف بنجاح');
    }


    public function deleteAll(Request $request)
    {
        $this->authorize('roles_delete');
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
