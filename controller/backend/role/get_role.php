<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Sanitize;
use Database\Models\Groups;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

    $group = Groups::where('id', $id)->first()->toArray(); 
 
    if($group){

        $id         = Sanitize::sanitize($group['id']);
        $name       = Sanitize::sanitize($group['name']);
        $roles      = json_decode($group['permissions'], true);
 
        [$status, $message, ] = ['success', 'Role details retireved successfully'];
        echo json_encode([
            'status' => $status, 
            'msg'    => $message,
            'id'     => $id,
            'name'   => $name,
            'roles'  => $roles
        ]);

    }else{
        [$status, $message, ] = ['error', 'Role details not found'];
        echo json_encode([
            'status'      =>$status, 
            'msg'         =>$message
        ]);
    }

}






?>