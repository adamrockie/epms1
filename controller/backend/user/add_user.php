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
use Classes\Hash;
use Database\Models\Employees;
use Database\Models\Users as UserModel;


$sessionName = Config::get('session/session_name');
$id = Session::get($sessionName);

$user = new User();

if($user->isLoggedIn() && Token::check(Input::get('token'))){

    $ippis       = Sanitize::sanitize(Input::get('selected_names'));
    $email       = Sanitize::sanitize(Input::get('email'));
    $password    = Sanitize::sanitize(Input::get('password'));
    $group_id    = Sanitize::sanitize(Input::get('role'));
    $office_id   = Sanitize::sanitize(Input::get('office_id'));
    $password    = Hash::make($password);


    $user_profile = Employees::where('ippis', '=', $ippis)->update([
        'official_email'  => $email,
    ]);

    $saved = UserModel::create([
        'ippis' => $ippis,
        'email'    => $email,
        'password' => $password,
        'status'   => 'active',
        'group_id' => $group_id,
        'office_id'=> $office_id
    ]);

    if($saved){
        
        [$status, $message] = ['success', 'User created successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, user could not be created'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }

}

?>
