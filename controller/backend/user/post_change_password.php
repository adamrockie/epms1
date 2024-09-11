<?php

/**
 * One framework
 * Author: Lamidi Ismaila
 * Email: dgoldenone@gmail.com
 */

require "config.php";

use Classes\Input;
use Classes\Token;
use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Hash;
use Database\Models\Users as UserModel;


$sessionName = Config::get('session/session_name');
$id = Session::get($sessionName);

$user = new User();

if($user->isLoggedIn() && Token::check(Input::get('token'))){

    $current_p  = $_POST['epassword'];
    $ippis      = $_POST['ippis'];
    $new_password   = Hash::make($current_p);

    // echo $ippis."<br>".$new_password;
    // exit;

    $saved = UserModel::Where('ippis', '=', $ippis)->update([
        'password' => $new_password
    ]);


    if($saved){
        
        [$status, $message] = ['success', 'Password updated successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, password could not be updated'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }

}

?>
