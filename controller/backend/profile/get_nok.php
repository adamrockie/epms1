<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Sanitize;
use Database\Models\NOK;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

    $nok = NOK::where('ippis', $id)->first(); 

    if($nok){

        $names        = Sanitize::sanitize($nok->names);
        $relationship = Sanitize::sanitize($nok->relationship);
        $phone_1      = Sanitize::sanitize($nok->phone_1);
        $phone_2      = Sanitize::sanitize($nok->phone_2);
        $dob          = Sanitize::sanitize($nok->dob);
        $email        = Sanitize::sanitize($nok->email);
        $ippis     = Sanitize::sanitize($nok->ippis);
        $address      = Sanitize::sanitize($nok->address);

        [$status, $message, ] = ['success', 'NOK details retireved successfully'];
        echo json_encode([
            'status'      =>$status, 
            'msg'         =>$message,
            'names'       =>$names,
            'relationship'=>$relationship,
            'phone_1'     =>$phone_1,
            'phone_2'     =>$phone_2,
            'dob'         =>$dob,
            'ippis'    =>$ippis,
            'email'       =>$email,
            'address'     =>$address
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