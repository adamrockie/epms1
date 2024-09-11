<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Database\Models\Emergency;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

    $emergency = Emergency::where('ippis', $id)->get()->toArray(); 

    if($emergency){

        $names        = Sanitize::sanitize($emergency[0]['names']);
        $relationship = Sanitize::sanitize($emergency[0]['relationship']);
        $phone_1      = Sanitize::sanitize($emergency[0]['phone_1']);
        $phone_2      = Sanitize::sanitize($emergency[0]['phone_2']);
        $type         = Sanitize::sanitize($emergency[0]['type']);
        $ippis     = Sanitize::sanitize($emergency[0]['ippis']);
        $id           = Sanitize::sanitize($emergency[0]['id']);
    
        $names2        = Sanitize::sanitize($emergency[1]['names']);
        $relationship2 = Sanitize::sanitize($emergency[1]['relationship']);
        $phone_12      = Sanitize::sanitize($emergency[1]['phone_1']);
        $phone_22      = Sanitize::sanitize($emergency[1]['phone_2']);
        $type2         = Sanitize::sanitize($emergency[1]['type']);
        $ippis2     = Sanitize::sanitize($emergency[1]['ippis']);
        $id2           = Sanitize::sanitize($emergency[1]['id']);


        [$status, $message, ] = ['success', 'Emergency details retireved successfully'];
        echo json_encode([
            'status'      =>$status, 
            'msg'         =>$message,
            'names'       =>$names,
            'relationship'=>$relationship,
            'phone_1'     =>$phone_1,
            'phone_2'     =>$phone_2,
            'type'        =>$type,
            'ippis'    =>$ippis,
            'names2'      =>$names2,
            'relationship2'=>$relationship2,
            'phone_12'    =>$phone_12,
            'phone_22'    =>$phone_22,
            'type2'       =>$type2,
            'id'          =>$id,
            'id2'         =>$id2,
        ]);

    }else{
        $name    = '';
        $branch_code = '';
        $office_id    = '';
        [$status, $message] = ['error', 'An error occurred, Emergency details could not be retrieved'];
        echo json_encode([
            'status'      =>$status, 
            'msg'         =>$message
        ]);
    }

}






?>