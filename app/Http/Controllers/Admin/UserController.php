<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Spatie\Permission\Models\Role;
Use App\Helpers\Helper;
use Spatie\Permission\Models\Permission;
use App\RoleHasPermission;
use DB;


class UserController extends Controller

{
    public function index(Request $request)
    {

        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        
        $type = isset($_GET['type']) ? $_GET['type'] : '1';
        $btnStatus = ($type == '1') ? '0' : '1';
        
        $userDetails = User::leftjoin('model_has_roles','model_has_roles.model_id', '=', 'users.id')
        ->leftjoin('roles','roles.id', '=', 'model_has_roles.role_id')
        ->where(['users.status' => $type])
        ->orderBy('users.id','DESC')
        ->select('users.id','users.name','users.email','users.created_at','users.status','users.updated_at','roles.name as role',DB::raw('GROUP_CONCAT(roles.name) as role'))
        ->groupBy('users.email')->get();
        
        return view('admin.user.index',compact('userDetails','btnStatus'));
        
    }

    public function create(Request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        $roleDetails = Role::orderBy('id')->get();
        return view('admin.user.create',compact('roleDetails'));
    }

    public function store(Request $request)
    {   
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        $input = $request->except('nameType', 'nameId', '_token', 'confirm-password', 'email_verified_at');
        
        if( !isset($input['id'])){
            // Create section

            // validate start
                $request->validate([
                    'name' => 'required|max:30',
                    'email' => 'required|max:100|unique:users,email',
                    'roles' => 'required', 
                ]);
            // validate start

            $input['password'] = Hash::make($input['password']);
            $input['email_verified_at'] = date('Y-m-d h:i:s');
            $user = User::create($input);
            $msg = 'User Successfuly Created.';

            if(!empty($user)){
                $newData = User::where(['id'=>$user->id])->first()->toArray();
                $oldData = [];
                $action = 'Create';
                $updateLogs = Helper::storeLogs($oldData,  $newData, $action, 'User');
                $roles = $request->input('roles') ? $request->input('roles') : [];
                $user->assignRole($roles);
                return redirect('admin/user'); 
            }else{
                return redirect()->back()->withErrors('Server Error Data not Updated');
            }   

        } else {
            // Edit section

            // validate start
            $request->validate([
                'name' => 'required|max:30',
                'email' => 'required|max:100|unique:users,email,'. $request->input('id'),
                'roles' => 'required', 
            ]);
            // validate start
            unset($input['email']);
            $user = User::findOrFail($input['id']);
            $oldData = User::where(['id' => $input['id']])->first()->toArray();
            $user->update($input);
            $newData = User::where(['id'=>$input['id']])->first()->toArray();
            $action = 'Update';
            $updateLogs = Helper::storeLogs($oldData,  $newData, $action, 'User');
            $msg = 'User Successfuly Updated.';

            if(!empty($user)){
                $roles = $request->input('roles') ? $request->input('roles') : [];
                $user->assignRole($roles);
                $user->syncRoles($roles);
                return redirect('admin/user');   
            }else{
                return redirect()->back()->withErrors('Server Error Data not Updated');
            }     
        }        
    }

    public function edit(Request $request)
    {   
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        $id = isset($_GET['user']) ? $_GET['user'] : '0';
        $userDetails = User::where(['id' => $id])->select('id', 'name', 'email', 'status')->first();
        $roleDetails = Role::orderBy('id')->get(['id', 'name']);
        $roleHasPermissions = User::leftjoin('model_has_roles','model_has_roles.model_id', '=', 'users.id')->where('model_has_roles.model_id', '=' , $id)->get();
        $data = [];
        
        if( !$roleHasPermissions->isEmpty() ){
            foreach($roleHasPermissions as $roleHasPermissionsVal){
                $data[] = $roleHasPermissionsVal['role_id'];
            }
        }
        return view('admin.user.create',compact('userDetails','roleDetails','data'));
    }

    public function update(Request $request,$id)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        $inputData = $request->all();
        //print_r($inputData);exit;

           // unset($inputData['password']);
            $user = User::findOrFail($id);
            $user->update($input);
            if(!empty($user)){
                $roles = $request->input('roles') ? $request->input('roles') : [];
                $user->syncRoles($roles);
                return redirect('admin/user'); 
            }else{
                return redirect()->back()->withErrors('Server Error Data not Updated');
            }
    }

}
