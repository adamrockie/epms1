<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Database\Models\Documents;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

    $id  = Sanitize::sanitize(Input::get('id'));

    $delete = Documents::where('id', '=', $id)
    ->delete();

    if($delete){
        
        [$status, $message] = ['success', 'Upload deleted successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, upload could not be deleted'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }
}


?>