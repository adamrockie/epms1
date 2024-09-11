<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Sanitize;
use Database\Models\Documents;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

    $doc = Documents::where('id', $id)->first();

    if($doc){

        $title        = Sanitize::sanitize($doc->title);
        $docx          = Sanitize::sanitize($doc->doc);
        $description  = Sanitize::sanitize($doc->description);
        $type_id      = Sanitize::sanitize($doc->type_id);
        $ippis     = Sanitize::sanitize($doc->ippis);
        $id           = Sanitize::sanitize($doc->id);

        [$status, $message, ] = ['success', 'Document details retireved successfully'];
        echo json_encode([
            'status'      =>$status, 
            'msg'         =>$message,
            'title'       =>$title,
            'doc'         =>$docx,
            'description' =>$description,
            'type_id'     =>$type_id,
            'ippis'    =>$ippis,
            'id'          =>$id
        ]);

    }else{
        $name    = '';
        $branch_code = '';
        $office_id    = '';
        [$status, $message] = ['error', 'An error occurred, NOK details could not be retrieved'];
        echo json_encode([
            'status'      =>$status, 
            'msg'         =>$message
        ]);
    }

}






?>