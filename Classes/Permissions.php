<?php
/**
 * One framework
 * Author: Lamidi Ismaila
 * Email: dgoldenone@gmail.com
 */


namespace Classes;

use Database\Models\Groups;
use Database\Models\Users as UserModel;

class Permissions{    

    public static function check($user_session_id, $role, $permission){

        $c_user     = UserModel::where('id', '=', $user_session_id)->first()->toArray();
        $user_group = $c_user['group_id'];
        $vrole      = Groups::where('id', '=', $user_group)->first()->toArray();
        $vrole      = json_decode($vrole['permissions'], true);
        $check      = array_key_exists($role, $vrole);

        if($check){
            $vpermission = $vrole[$role];
            $check_perm = array_key_exists($permission, $vpermission);
            if($check_perm){
                return true;   
            }else{
                return false;
            }
        }else{
            echo 'role does not exist';
        }
    }

    public static function get_role($user_session_id){
        $c_user     = UserModel::where('id', '=', $user_session_id)->first()->toArray();
        $user_group = $c_user['group_id'];
        $vrole      = Groups::where('id', '=', $user_group)->first()->toArray();
        return $vrole['name'];
    }

 
}