<?php
require "config.php";

use Database\Models\Offices;
use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Classes\Token;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn() && Token::check(Input::get('token'))){

    $office_id  = Sanitize::sanitize(Input::get('office_id'));

    $delete = Offices::where('office_id', '=', $office_id)
    ->delete();

    if($delete){
        
        [$status, $message] = ['success', 'Office deleted successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, office could not be deleted'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }
}


?>