<?php

/**
 * One framework
 * Author: Lamidi Ismaila
 * Email: dgoldenone@gmail.com
 */

require "config.php";

use Classes\Validate;
use Classes\Input;
use Classes\Token;
use Classes\User;
use Classes\Session;
use Classes\Sanitize;
use Classes\Config;
use Database\Models\Groups;


$sessionName = Config::get('session/session_name');
$id = Session::get($sessionName);

$user = new User();

if($user->isLoggedIn() && Token::check(Input::get('token'))){

    $name    = Sanitize::sanitize(Input::get('role'));

    $saved = Groups::insert([
        'name' => $name
    ]);

    if($saved){
        
        [$status, $message] = ['success', 'Role created successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, role could not be created'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }

}

?>
