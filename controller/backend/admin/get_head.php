<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Sanitize;
use Database\Models\DocumentTypes;
use Database\Models\Heads;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

    

    $head = Heads::where('id', $id)->first();
    if($head){
        $ippis       = Sanitize::sanitize($head->ippis);
        $office_id      = Sanitize::sanitize($head->office_id);
        $staff_status   = Sanitize::sanitize($head->status);
        $doa            = Sanitize::sanitize($head->doa);
        $dot            = Sanitize::sanitize($head->dot);

        [$status, $message, ] = ['success', 'Site HR  retrieved successfully'];
        echo json_encode([
            'status'   =>$status, 
            'msg'      =>$message,
            'ippis' =>$ippis,
            'office_id'=>$office_id,
            'staff_status'=>$staff_status,
            'doa'      =>$doa,
            'dot'      =>$dot,
            'id'       =>$id
        ]);

    }else{

        [$status, $message] = ['error', 'An error occurred, Site HR not found'];
        echo json_encode([
            'status'      =>$status, 
            'msg'         =>$message,
        ]);
    }

}






?>