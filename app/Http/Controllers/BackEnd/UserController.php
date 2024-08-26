<?php

namespace App\Http\Controllers\BackEnd;

use Image;
use Storage;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BackEnd\User\Store;
use App\Http\Requests\BackEnd\User\Update;

class UserController extends Controller
{
    protected $modelName;
    protected $routeName;
    protected $pageName;
    protected $viewName;

    public function __construct(User $model)
    {
        $this->modelName = $model;
        $this->routeName = "users";
        $this->pageName  = "Users";
        $this->viewName  = "backend.users.";
    }



    public function append()
    {
        $array = [
            'roles' => Role::get(),
            'selectedRole' => [],
        ];

        if(request()->route()->parameter('user')){
            $user_id = request()->route()->parameter('user');
            $array['selectedRole'] = $this->modelName->findOrFail($user_id)
                                        ->roles()->get()->pluck('id')->toArray();
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
        $this->authorize('users_list');
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
        $this->authorize('users_create');

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
        $this->authorize('users_create');

        $validatedData = $request->validated();

        unset($validatedData['roles']);

        if($request->hasFile('image'))
        {
            Image::make($request->image)->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/users/'.$request->image->hashName()));

            $validatedData['image'] = "uploads/users/".$request->image->hashName();
        }  
        
        $validatedData['password'] = bcrypt($request->password);
        
        $record = $this->modelName->create($validatedData);

        $record->assignRole($request->roles);
        
        return redirect()->route($this->routeName.'.index')
            ->with('success', 'تم الاضافة بنجاح');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('users_update');

        $record = $this->modelName->findOrFail($id);
        $append = $this->append();
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
        $this->authorize('users_update');

        $record = $this->modelName->findOrFail($id);

        $validatedData = $request->validated();

        if($request->hasFile('image'))
        {

            Storage::delete($record->image);

            Image::make($request->image)->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/users/'.$request->image->hashName()));

            $validatedData['image'] = "uploads/users/".$request->image->hashName();
        }

        if(!is_null($validatedData['password']))
        {
            $validatedData['password'] = bcrypt($request->password);
        }else{
            unset($validatedData['password']);
        }

        unset($validatedData['roles']);

        $record->update($validatedData);

        $record->assignRole($request->roles);

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
        $this->authorize('users_delete');

        $record = $this->modelName->findOrFail($id);

        if(!is_null($record->image))
        {
            Storage::delete($record->image);
        }
        $record->delete();
        return redirect()->route($this->routeName.'.index')
                    ->with('success', 'تم الحذف بنجاح');
    }


    public function deleteAll(Request $request)
    {
        $this->authorize('users_delete');
        
        $ids = $request->ids;
        $count = count($ids);
        foreach($ids as $id)
        {
            $record = $this->modelName->findOrFail($id);

             if(!is_null($record->image))
            {
                Storage::delete($record->image);
            }
            $record->delete();
        }
         return redirect()->route($this->routeName.'.index')
                    ->with('success', 'تم حذف '.$count.' من السجلات بنجاح');
    }
}
