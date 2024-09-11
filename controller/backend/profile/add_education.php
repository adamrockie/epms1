<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Database\Models\Education;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

        $institution   = Sanitize::sanitize(Input::get('institution'));
        $qualification = Sanitize::sanitize(Input::get('qualification'));
        $start_date    = Sanitize::sanitize(Input::get('start_date'));
        $end_date      = Sanitize::sanitize(Input::get('end_date'));
        $grade         = Sanitize::sanitize(Input::get('grade'));
        $ippis      = Sanitize::sanitize(Input::get('sid'));

        $saved = Education::insert([
            'institution'   => $institution,
            'qualification' => $qualification,
            'start_date'    => $start_date,
            'end_date'      => $end_date,
            'grade'         => $grade,
            'ippis'      => $ippis
        ]);

    if($saved){
        
        [$status, $message] = ['success', 'Education details saved successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, Education details could not be added'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }


}






?>