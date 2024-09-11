<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Classes\Token;
use Database\Models\Units;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);


$user = new User();
if($user->isLoggedIn() && Token::check(Input::get('token'))){

    $name      = Sanitize::sanitize(Input::get('name'));
    $location  = Sanitize::sanitize(Input::get('location'));
    $office_id = Sanitize::sanitize(Input::get('oid'));
    $unit_id   = rand(100, 99999).date('hms');

    $saved = Units::create([
        'name'        => $name,
        'location'    => $location,
        'office_id'   => $office_id,
        'unit_id'     => $unit_id
    ]);

    if($saved){
        
        
        [$status, $message] = ['success', 'Unit added successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, unit could not be added'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }


}






?>