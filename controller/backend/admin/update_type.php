<?php
require "config.php";

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

    $name        = Sanitize::sanitize(Input::get('name'));
    $description = Sanitize::sanitize(Input::get('description'));
    $type_id     = Sanitize::sanitize(Input::get('type_id'));

    $saved = DocumentTypes::where('id', '=', $type_id)
    ->update([
        'name'        => $name,
        'description' => $description
    ]);

    if($saved){
        
        [$status, $message] = ['success', 'Document type updated successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, Document type could not be updated'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }


}






?>