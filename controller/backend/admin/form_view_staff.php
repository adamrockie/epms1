<?php
require "config.php";


use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Classes\Token;
use Database\Models\Heads;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn() && Token::check(Input::get('token'))){



    $staff_id  = Input::get('staff');

    //header("Location: profile/326");
    //exit();

    $saved = true;


    if($saved){
        
        [$status, $message] = ['success', 'Staff profile found', $staff_id];
        echo json_encode(['status'=>$status, 'msg'=>$message, 'staff_id'=>$staff_id]);

    }else{

        [$status, $message] = ['error', 'An error occurred, Staff profile could not be found'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }


}






?>