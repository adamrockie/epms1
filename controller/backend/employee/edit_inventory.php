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
    
    // Get ID from URL
    $id = $_GET['id'];

    $items = inventory::where('id', $id)->first();




    if($items){
        $id                         = $items['id'];
        $inventory              = $items['inventory'];
        $amount                 = $items['amount'];
        $cstatus                = $items['status'];
        $warranty               = $items['warranty'];
        $quantity               = $items['quantity'];
        $date                   = $items['date'];
        $upload                 = $items['upload'];
            

        [$status, $message, ] = ['success', 'inventory retrieved successfully'];
        echo json_encode([
            'id'                    => $id,
            'inventory'         => $inventory,
            'amount'            => $amount,
            'cstatus'           => $cstatus,
            'warranty'          => $warranty,
            'quantity'          => (string)$quantity,
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