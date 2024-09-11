<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Database\Models\NOK;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){


        $names        = Sanitize::sanitize(Input::get('nok_names'));
        $relationship = Sanitize::sanitize(Input::get('nok_relationship'));
        $dob          = Sanitize::sanitize(Input::get('nok_dob'));
        $phone_1      = Sanitize::sanitize(Input::get('nok_phone'));
        $phone_2      = Sanitize::sanitize(Input::get('nok_phone2'));
        $email        = Sanitize::sanitize(Input::get('nok_email'));
        $address      = Sanitize::sanitize(Input::get('nok_address'));
        $ippis     = Sanitize::sanitize(Input::get('sid'));

        $saved = NOK::insert([
            'names'        => $names,
            'relationship' => $relationship,
            'phone_1'      => $phone_1,
            'phone_2'      => $phone_2,
            'email'        => $email,
            'address'      => $address,
            'ippis'     => $ippis
        ]);

    if($saved){
        
        [$status, $message] = ['success', 'Next of Kin details saved successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, Next of Kin details could not be added'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }


}






?>