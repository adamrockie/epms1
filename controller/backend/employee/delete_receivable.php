<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Database\Models\Employees;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

    $ippis  = Sanitize::sanitize(Input::get('ippis'));

    $delete = Employees::where('ippis', '=', $ippis)
    ->delete();

    if($delete){
        
        [$status, $message] = ['success', 'Employee deleted successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, employee could not be deleted'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }
}


?>