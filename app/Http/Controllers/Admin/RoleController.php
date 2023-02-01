<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Response;
use Auth;
use DB;
use App\Role;
use App\Permission;
use App\RoleHasPermission;
use App\Http\Requests\StoreRolesRequest;
use App\Http\Requests\UpdateRolesRequest;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if (!Gate::allows('role_manage')) {
            return abort(401);
        }
        $roleDetails = Role::orderBy('id')->select('id', 'name', 'updated_at')->get();
        return view('admin.role.index',compact('roleDetails'));
    }

    public function create(Request $request)
    {
        // if (!Gate::allows('role_manage')) {
        //     return abort(401);
        // }
        $permissionDetails = Permission::orderBy('id')->get();
        return view('admin.role.create',compact('permissionDetails'));
    }

    public function store(Request $request)
    {          
        if (!Gate::allows('role_manage')) {
            return abort(401);
        }
        $input = $request->except('nameType', 'nameId', '_token');
        $rolePerm = null;
        if( !isset($input['id'])){
            // Create section

            // validate start
                $request->validate([
                    'name' => 'required|max:30|unique:roles,name',
                    'permission' => 'required', 
                ]);
            // validate start

            $role = Role::create($input);
            $roleId = $role->id;
            $msg = 'Role Successfuly Created.';    

        } else {
            // Edit section

            // validate start
            $request->validate([
                'name' => 'required|max:30|unique:roles,name,'. $request->input('id'),
                'permission' => 'required',
            ]);
            // validate start

            $roles['name']= $input['name'];
            $role = Role::findOrFail($input['id']);
            $role->update($roles);
                $roleHasPermissions = RoleHasPermission::where('role_id','=',$input['id'])->delete();
                $roleId = $input['id'];   
            $msg = 'Role Successfuly Updated.';    
        }
        //print_r($roleId);exit;
        foreach ($input['permission'] as $key =>$value) {               
            $dataPer=array();
            $dataPer['permission_id']=$value;
            $dataPer['role_id']=$roleId;

            $rolePerm = RoleHasPermission::create($dataPer);
            if( !empty($rolePerm->id) ){
                return redirect('admin/role/create');
            }
        }

       // $permissions = $request->input('permission') ? $request->input('permission') : [];

       // $role->givePermissionTo($permissions);
        //$role->syncPermissions($request->input('permission'));
        $this->syncronizeRoles();
        return redirect('admin/role');
        
    }

    public function edit(Request $request)
    {
        if (!Gate::allows('role_manage')) {
            return abort(401);
        }
        $id = isset($_GET['role']) ? $_GET['role'] : '0';
        $roleDetails = Role::where('id', $id)->first();
        $permissionDetails = Permission::get();
        $roleHasPermissions = RoleHasPermission::where('role_id', $id)->get();
        $data = [];
        if(!empty($roleHasPermissions)){
            foreach($roleHasPermissions as $roleHasPermissionsVal){
                $data[] = $roleHasPermissionsVal['permission_id'];
            }
        }
        return view('admin.role.create',compact('roleDetails','permissionDetails','data'));
    }

    public static function syncronizeRoles(){
        $user = Auth::user();
        //print_R($user);exit;
        $roles = DB::table('model_has_roles')->where(['model_id'=>$user->id])->select('role_id')->get();
        $tempRoleArr = array();
        if( !empty($roles) ){
            foreach ($roles as $key => $value) {
                array_push($tempRoleArr, $value->role_id);
            }
        }

        ($user->syncRoles($tempRoleArr));
    }

}
