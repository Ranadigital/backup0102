<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Permission;
use App\RoleHasPermission;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Controller;

class UserPermissionController extends Controller
{
    public function index(Request $request)
    {
       // if (!Gate::allows('permission_manage')) {
       //      return abort(401);
       //  }
        $permissionDetails = Permission::orderBy('id')->get();
        return view('admin.permission.index',compact('permissionDetails'));
    }

    public function create(Request $request)
    {
        // if (!Gate::allows('permission_manage')) {
        //     return abort(401);
        // }
        $view =   view('admin.permission.create')->render();
        if(!empty($view)){
            return response()->json(['code' => 200, 'view' => $view]);
        }else{
            return response()->json(['code' => 100, 'view' => '']);
        }
    }

    public function store(Request $request)
    {   
        // if (!Gate::allows('permission_manage')) {
        //     return abort(401);
        // }
        $inputData = $request->all();
        $permission = Permission::create($request->all());
        $permission_id = $permission->id;
        // $superAdmin = Role::where('name', '=', "admin")->select('id')->first();
        // $superAdmin = $superAdmin->id;
        $dataPer=array();
        // $dataPer['permission_id']=$permission_id;
        // $dataPer['role_id']=$superAdmin;
        // $rolePerm = RoleHasPermission::create($dataPer);
        //$syncRole = RoleController::syncronizeRoles();
        if(!empty($rolePerm)){
            return redirect()->route('admin/permission');   
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        }
    }

    public function edit(Request $request)
    {
        // if (!Gate::allows('permission_manage')) {
        //     return abort(401);
        // }
        $inputData = $request->all();
        $id = $inputData['id'];
        $permissionDetails = Permission::where(['id' => $id])->first();
        $view = view('permission.create',compact('permissionDetails'))->render();
        if(!empty($view)){
            return response()->json(['code' => 200, 'view' => $view]);
        }else{
            return response()->json(['code' => 100, 'view' => '']);
        }
    }

    public function update(Request $request,$id)
    {
        // if (!Gate::allows('permission_manage')) {
        //     return abort(401);
        // }
        $inputData = $request->all();
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());
        $syncRole = RoleController::syncronizeRoles();
        if(empty($permission)){
            return redirect()->route('permission.index');   
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        }
          
    }
    


}
