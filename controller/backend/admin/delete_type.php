<?php
require "config.php";

use Database\Models\Offices;
use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Database\Models\DocumentTypes;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

    $id  = Sanitize::sanitize(Input::get('type_id'));

    $delete = DocumentTypes::where('id', '=', $id)
    ->delete();

    if($delete){
        
        [$status, $message] = ['success', 'Document type deleted successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, Document type could not be deleted'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }
}


?>