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

    $items = inventory::where('id', '=', $id)->first();
    if($items){

    $inventory              = $items['inventory'];
    $amount                 = $items['amount'];
    $cstatus                = $items['status'];
    $warranty               = $items['warranty'];
    $date                   = $items['date'];
    $upload                 = $items['upload'];
        

        [$status, $message, ] = ['success', 'inventory retrieved successfully'];
        echo json_encode([
            'inventory'         => $inventory,
            'amount'            => $amount,
            'cstatus'           => $cstatus,
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