<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Sanitize;
use Database\Models\Receiveable;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

    $items = Receiveable::where('id', $id)->first();
    if($items){

    
    $id                         = uniqid();
    $contract                   = $items['contract'];
    $contractor                 = $items['contractor'];
    $lot_number                 = $items['lot_number'];
    $status                     = $items['status'];
    $email                      = $items['email'];
    $phone_number               = $items['phone_number'];
    $date                       = $items['date'];
    $upload                     = $items['upload'];
        

        [$status, $message, ] = ['success', 'contract information retrieved successfully'];
        echo json_encode([
            
            'contract'              => $contract,
            'contractor'            => $contractor,
            'lot_number'            => $lot_number,
            'status'                => $status,
            'email'                 => $email,
            'phone_number'          => $phone_number,
            'date'                  => $date,
            'upload'                => $upload,
            
        ]);

    }else{

        [$status, $message] = ['error', 'An error occurred, contract information could not be added'];
        echo json_encode([
            'status'=>$status, 
            'msg'=>$message
        ]);
    }

}


?>