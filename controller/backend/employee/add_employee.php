<?php

/**
 * One framework
 * Author: Lamidi Ismaila
 * Email: dgoldenone@gmail.com
 */


//require_once $_SERVER['DOCUMENT_ROOT']."/setraco/config.php";
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Classes\Token;
use Database\Models\Inventory;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn() && Token::check(Input::get('token'))){


    $uploadf      = 'null';
    $upload_status = '0';


            /**
             * Upload Script Starts here
             */

            $file_name=null;
            $uploads = $_SERVER['DOCUMENT_ROOT']."/epms1/uploads/inventory/";

            if($_FILES){
                $validextensions = array("jpg", "jpeg", "png");
                $temporary  = explode(".", $_FILES["upload"]["name"]);            
                $file_extension  = end($temporary);
                    if ($_FILES["upload"]["error"] > 0) 
                    {
                       // echo "Return Code: " . $_FILES["passport"]["error"] . "<br/><br/>";
                       $upload_status = '0';
                    } else {
                                $temporary          = explode(".", $_FILES["upload"]["name"]);
                                $file_extension     = end($temporary);
                                
                                $file_name  = uniqid();

                                if(move_uploaded_file($_FILES["upload"]["tmp_name"], $uploads.$file_name.'.'.$file_extension)) {
                                    $uploadf = $file_name.'.'.$file_extension; 
                                    $upload_status = '1';
                                }         
                        }
            }

            /**
            * Upload Script Ends here 
            */

    $id                     = uniqid();
    $inventory              = Sanitize::sanitize(Input::get('inventory'));
    $amount                 = Sanitize::sanitize(Input::get('amount'));
    $status                 = Sanitize::sanitize(Input::get('status'));
    $warranty               = Sanitize::sanitize(Input::get('warranty'));
    $date                   = Sanitize::sanitize(Input::get('date'));
        
    if($upload_status == 1){

        $saved = Inventory::create([
            
            'inventory'         => $inventory,
            'amount'            => $amount,
            'status'            => $status,
            'warranty'          => $warranty,
            'date'              => $date,
            'upload'            => $uploadf,
            
        ]);
    
        if($saved){
            
            [$status, $message] = ['success', 'Inventory created successfully'];
            echo json_encode(['status'=>$status, 'msg'=>$message]);
    
        }else{
    
            [$status, $message] = ['error', 'An error occurred, inventory could not be created, please try again.'];
            echo json_encode(['status'=>$status, 'msg'=>$message]);
        }
    

    }else{

        [$status, $message] = ['error', 'An error occurred in the uploaded image, inventory could not be added, please try again.'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }

    

}






?>