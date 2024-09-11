<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Sanitize;
use Database\Models\Employees;
use Database\Models\Users as UsersModel;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

    $staff = Employees::where('ippis', $id)->with('office')->first()->toArray(); 
    $group_id = UsersModel::where('ippis', $id)->first()->group_id;
 
    if($staff){

        $ippis      = Sanitize::sanitize($staff['ippis']);
        $email      = Sanitize::sanitize($staff['official_email']);
        $office     = Sanitize::sanitize($staff['office']);
        $staff_status     = Sanitize::sanitize($staff['status']);

        [$status, $message, ] = ['success', 'User details retireved successfully'];
        echo json_encode([
            'status'      => $status, 
            'msg'         => $message,
            'ippis'       => $ippis,
            'email'       => $email,
            'staff_status'=> $staff_status,
            'office_name' => $office,
            'group_id'    => $group_id 
        ]);

    }else{
        [$status, $message, ] = ['error', 'User details not found'];
        echo json_encode([
            'status'      =>$status, 
            'msg'         =>$message
        ]);
    }

}






?>