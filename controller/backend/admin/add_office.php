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
    $type        = Sanitize::sanitize(Input::get('type'));
    $office_id   = rand(100, 99999).date('hms');

    $saved = Offices::create([
        'name'        => $name,
        'location'    => $branch_code,
        'office_id'   => $office_id,
        'created_by_id'=> $uid
    ]);

    if($saved){
        
        [$status, $message] = ['success', 'Site added successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, site could not be added'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }


}






?>