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
use Classes\Sanitize;
use Classes\Config;
use Database\Models\Groups;


$sessionName = Config::get('session/session_name');
$id = Session::get($sessionName);

$user = new User();

if($user->isLoggedIn() && Token::check(Input::get('token'))){

    $permissions   = json_encode($_POST['access']) ;
    $permission_id = Sanitize::sanitize(Input::get('permission_id'));

    $saved = Groups::where('id', '=', $permission_id)->update([
        'permissions' => $permissions
    ]);       

    if($saved){
        
        [$status, $message] = ['success', 'Permissions updated successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, Permissions could not be updated'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }

}

?>
