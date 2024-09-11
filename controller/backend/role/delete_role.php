<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Database\Models\Groups;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

    $group_id  = Sanitize::sanitize(Input::get('group_id'));

    $delete = Groups::where('id', '=', $group_id)
    ->delete();

    if($delete){
        
        [$status, $message] = ['success', 'Role deleted successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, role could not be deleted'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }
}


?>