<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Sanitize;
use Database\Models\Education;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

    $education = Education::where('id', $id)->get()->toArray(); 
 
    if($education){

        $institution   = Sanitize::sanitize($education[0]['institution']);
        $qualification = Sanitize::sanitize($education[0]['qualification']);
        $start_date    = Sanitize::sanitize($education[0]['start_date']);
        $end_date      = Sanitize::sanitize($education[0]['end_date']);
        $grade         = Sanitize::sanitize($education[0]['grade']);
        $id            = Sanitize::sanitize($education[0]['id']);


        [$status, $message, ] = ['success', 'Education details retireved successfully'];
        echo json_encode([
            'status'      => $status, 
            'msg'         => $message,
            'institution' => $institution,
            'qualification'=> $qualification,
            'start_date'  => $start_date,
            'end_date'    => $end_date,
            'grade'       => $grade,
            'id'          => $id,
            
        ]);

    }else{
        $name    = '';
        $branch_code = '';
        $office_id    = '';
        [$status, $message] = ['error', 'An error occurred, Education details could not be retrieved'];
        echo json_encode([
            'status'      =>$status, 
            'msg'         =>$message
        ]);
    }

}






?>