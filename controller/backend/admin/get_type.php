<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Sanitize;
use Database\Models\DocumentTypes;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

    $doctype = DocumentTypes::where('id', $id)->first();
    if($doctype){
        $name        = Sanitize::sanitize($doctype->name);
        $description = Sanitize::sanitize($doctype->description);
        $id          = Sanitize::sanitize($doctype->id);

        [$status, $message, ] = ['success', 'Type retireved successfully'];
        echo json_encode([
            'status'     =>$status, 
            'msg'        =>$message,
            'name'       =>$name,
            'description'=>$description,
            'id'=>$id
        ]);

    }else{

        [$status, $message] = ['error', 'An error occurred, Type not found'];
        echo json_encode([
            'status'      =>$status, 
            'msg'         =>$message,
        ]);
    }

}






?>