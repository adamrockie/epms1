<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Sanitize;
use Database\Models\Employees;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

    $staff = Employees::where('ippis', $id)->with('office')->first()->toArray(); 
 
    if($staff){

        $ippis          = Sanitize::sanitize($staff['ippis']);
        $personal_email = Sanitize::sanitize($staff['personal_email']);
        $official_email = Sanitize::sanitize($staff['official_email']);
        //$office_id      = Sanitize::sanitize($staff['office_id']);
        //$office_name    = Sanitize::sanitize($staff['office']['name']);

        [$status, $message, ] = ['success', 'User details retireved successfully'];
        echo json_encode([
            'status'         => $status, 
            'msg'            => $message,
            'ippis'          => $ippis,
            'personal_email' => $personal_email,
            'official_email' => $official_email,
           // 'office_id'      => $office_id,
           // 'office_name'    => $office_name
        ]);

    }else{
        [$status, $message, ] = ['error', 'User details not found'];
        echo json_encode([
            'status'      =>$status, 
            'msg'         =>$message
        ]);
    }

}






?>