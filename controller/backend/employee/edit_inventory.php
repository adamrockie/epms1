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
        $status                = $items['status'];
        $warranty               = $items['warranty'];
        $life_span              =  $items['life_span'];
        $item_type              =  $items['item_type'];
        $category              =  $items['category'];
        $serial_no               = $items['serial_no'];
        $date                   = $items['date'];
        $upload                 = $items['upload'];
            

        [$save_status, $message, ] = ['success', 'inventory retrieved successfully'];
        echo json_encode([
            'id'                    => $id,
            'inventory'         => $inventory,
            'amount'            => $amount,
            'status'           => $status,
            'warranty'          => $warranty,
            'life_span'         => $life_span,
            'item_type'         => $item_type,
            'category'         => $category,
            'serial_no'          => $serial_no,
            'date'              => $date,
            'upload'            => $upload,
            
        ]);

    }else{

        [$save_status, $message] = ['error', 'An error occurred, inventory could not be added'];
        echo json_encode([
            'status'=>$status, 
            'msg'=>$message
        ]);
    }

}


?>