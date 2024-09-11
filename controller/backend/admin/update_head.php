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


    $id        = Sanitize::sanitize(Input::get('eid'));
    $ippis  = Sanitize::sanitize(Input::get('staff'));
    $office_id = Sanitize::sanitize(Input::get('site'));

    $saved = Heads::where('id', '=', $id)
    ->update([
        'ippis'  => $ippis,
        'office_id' => $office_id
    ]);

    if($saved){
        
        [$status, $message] = ['success', 'Site HR updated successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, Site HR could not be updated'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }


}






?>