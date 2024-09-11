<?php
require "config.php";

use Database\Models\Offices;
use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

    $office = Offices::where('office_id', $id)->first();
    if($office){
        $name        = Sanitize::sanitize($office->name);
        $branch_code = Sanitize::sanitize($office->branch_code);
        $office_id   = Sanitize::sanitize($office->office_id);

        [$status, $message, ] = ['success', 'Site retireved successfully'];
        echo json_encode([
            'status'     =>$status, 
            'msg'        =>$message,
            'name'       =>$name,
            'branch_code'=>$branch_code,
            'office_id'  => $office_id,
        ]);

    }else{
        $name    = '';
        $branch_code = '';
        $office_id    = '';
        [$status, $message] = ['error', 'An error occurred, site could not be added'];
        echo json_encode([
            'status'      =>$status, 
            'msg'         =>$message,
            'name'        =>$name,
            'branch_code' =>$branch_code,
            'office_id'   =>$office_id
        ]);
    }

}






?>