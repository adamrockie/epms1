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

var_dump($_POST);
die();

$user = new User();
if($user->isLoggedIn()){

    $uniqid  = Sanitize::sanitize(Input::get('uniqid'));

    $delete = Offices::where('uniqid', '=', $uniqid)
    ->delete();

    if($delete){
        
        [$status, $message] = ['success', 'Office deleted successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, office could not be deleted'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }
}


?>