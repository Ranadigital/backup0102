<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    public $timestamps = false;
    public $fillable = ['permission_id','role_id'];
    
    public static function getPermission($permissionId, $roleId){
        
      $permission=self::where(['permission_id'=>$permissionId, 'role_id'=>$roleId])->get();
      if(!empty($permission) && !empty($permission[0])){
         return $permission;
      }else{
          return false;
      }
    }
    

}