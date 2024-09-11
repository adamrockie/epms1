<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Classes\Token;
use Database\Models\LeaveTypes;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn() && Token::check(Input::get('token'))){

        $name     = Sanitize::sanitize(Input::get('name'));
        $days     = Sanitize::sanitize(Input::get('days'));
        $category = Sanitize::sanitize(Input::get('category'));

        $saved = LeaveTypes::create([
            'name'     => $name,
            'days'     => $days,
            'level'    => $category
        ]);

    if($saved){
        
        [$status, $message] = ['success', 'Leave Type created successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, Leave Type could not be created'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }


}






?>