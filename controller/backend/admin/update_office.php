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

    $name        = Sanitize::sanitize(Input::get('name'));
    $branch_code = Sanitize::sanitize(Input::get('branch_code'));
    $office_id   = Sanitize::sanitize(Input::get('office_id'));

    $saved = Offices::where('office_id', '=', $office_id)
    ->update([
        'name'        => $name,
        'branch_code' => $branch_code
    ]);

    if($saved){
        
        [$status, $message] = ['success', 'Site updated successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, Site could not be updated'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }


}






?>