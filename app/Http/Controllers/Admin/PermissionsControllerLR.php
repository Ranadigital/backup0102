<?php

namespace App\Http\Controllers\Admin;
use App\RoleHasPermission;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePermissionsRequest;
use App\Http\Requests\Admin\UpdatePermissionsRequest;

use Spatie\Permission\Models\Role;

class PermissionsControllerLR extends Controller
{
    /**
     * Display a listing of Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        
        $permissions = Permission::orderBy('id', 'DESC')->get();
       
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating new Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
       
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionsRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $permission = Permission::create($request->all());
        $permission_id = $permission->id;
        $superAdmin = Role::where('name', '=', "administrator")->select('id')->get()->toArray();
        $superAdmin = $superAdmin[0]['id'];
        $dataPer=array();
            $dataPer['permission_id']=$permission_id;
            $dataPer['role_id']=$superAdmin;
            $dataPer['per_create']=  1;      
            $dataPer['per_edit']= 1; 
            $dataPer['per_delete']= 1; 
            $dataPer['per_view']= 1; 
            $rolePerm = RoleHasPermission::create($dataPer);
       
        return redirect()->route('admin.permissions.index');
    }


    /**
     * Show the form for editing Permission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
    public function edit($id)
    {  
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $permission = Permission::findOrFail($id);

        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionsRequest $request, $id)
    {
        
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());

        return redirect()->route('admin.permissions.index');
    }


    /**
     * Remove Permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect()->route('admin.permissions.index');
    }

    /**
     * Delete all selected Permission at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Permission::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
