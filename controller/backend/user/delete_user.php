<?php
require "config.php";

use Database\Models\Offices;
use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Database\Models\Users as UserModel;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){


    $ippis  = Sanitize::sanitize(Input::get('ippis'));

    $delete = UserModel::where('ippis', '=', $ippis)
    ->delete();

    if($delete){
        
        [$status, $message] = ['success', 'User deleted successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, user could not be deleted'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }
}


?>