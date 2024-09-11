<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Sanitize;
use Database\Models\LeaveTypes;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

    $leave = LeaveTypes::where('id', $id)->get()->toArray(); 
 
    if($leave){

        $name   = Sanitize::sanitize($leave[0]['name']);
        $days   = Sanitize::sanitize($leave[0]['days']);
        $level  = Sanitize::sanitize($leave[0]['level']);
        $id     = Sanitize::sanitize($leave[0]['id']);

        [$status, $message, ] = ['success', 'Leave details retrieved successfully'];
        echo json_encode([
            'name'  => $name, 
            'days'  => $days,
            'level' => $level,
            'id'    => $id
        ]);

    }else{
        [$status, $message, ] = ['error', 'Leave details not found'];
        echo json_encode([
            'status'      =>$status, 
            'msg'         =>$message
        ]);
    }

}

?>