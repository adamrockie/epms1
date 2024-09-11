<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Sanitize;
use Database\Models\Inventory;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

    $items = inventory::where('id', $id)->first();
    if($items){

    $title                  = Sanitize::sanitize(Input::get('title'));
    $id                     = uniqid();
    $inventory              = Sanitize::sanitize(Input::get('inventory'));
    $amount                 = Sanitize::sanitize(Input::get('amount'));
    $status                 = Sanitize::sanitize(Input::get('status'));
    $warranty               = Sanitize::sanitize(Input::get('warranty'));
    $date                   = Sanitize::sanitize(Input::get('date'));
    $upload                 = Sanitize::sanitize(Input::get('upload'));
        

        [$status, $message, ] = ['success', 'inventory retrieved successfully'];
        echo json_encode([
            'title'             => $title,
            'inventory'         => $inventory,
            'amount'            => $amount,
            'status'            => $status,
            'warranty'          => $warranty,
            'date'              => $date,
            'upload'            => $upload,
            
        ]);

    }else{

        [$status, $message] = ['error', 'An error occurred, inventory could not be added'];
        echo json_encode([
            'status'=>$status, 
            'msg'=>$message
        ]);
    }

}


?>