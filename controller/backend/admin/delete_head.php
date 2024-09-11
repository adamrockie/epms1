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


    $id  = Sanitize::sanitize(Input::get('head_id'));

    $delete = Heads::where('id', '=', $id)
    ->delete();

    if($delete){
        
        [$status, $message] = ['success', 'Site HR deleted successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, Site HR could not be deleted'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }
}


?>