<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Database\Models\Inventory;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);


$user = new User();
if($user->isLoggedIn()){

    $title                  = Sanitize::sanitize(Input::get('title'));
    $id                     = uniqid();
    $inventory              = Sanitize::sanitize(Input::get('inventory'));
    $amount                 = Sanitize::sanitize(Input::get('amount'));
    $status                 = Sanitize::sanitize(Input::get('status'));
    $warranty               = Sanitize::sanitize(Input::get('warranty'));
    $date                   = Sanitize::sanitize(Input::get('date'));
    $upload                 = Sanitize::sanitize(Input::get('upload'));
        
    $upload_status = '0';


            /**
             * Upload Script Starts here
             */


            $file_name=null;
            $uploads = $_SERVER['DOCUMENT_ROOT']."/epms/uploads/profile_pic/";

            if($_FILES["upload"]["name"]){
                $validextensions = array("jpg", "jpeg", "png");
                $temporary  = explode(".", $_FILES["upload"]["name"]);            
                $file_extension  = end($temporary);
                    if ($_FILES["upload"]["error"] > 0) 
                    {
                       $upload_status = '0';
                    } else {
                                $temporary          = explode(".", $_FILES["upload"]["name"]);
                                $file_extension     = end($temporary);
                                
                                $file_name  = $ippis;

                                if(move_uploaded_file($_FILES["upload"]["tmp_name"], $uploads.$file_name.'.'.$file_extension)) {
                                    $passport = $file_name.'.'.$file_extension; 
                                    $upload_status = '1';
                                }         
                        }

                        $saved = Inventory::where('id', '=', $id)
                        ->update([
                            'inventory'         => $inventory,
                            'amount'            => $amount,
                            'status'            => $status,
                            'warranty'          => $warranty,
                            'date'              => $date,
                            'upload'            => $upload,
                        ]);

            }else{
                $saved = Inventory::where('id', '=', $id)
                ->update([
                    
                    
                    'inventory'         => $inventory,
                    'amount'            => $amount,
                    'status'            => $status,
                    'warranty'          => $warranty,
                    'date'              => $date,
                    'upload'            => $upload,
                ]);
               
            }

            /**
            * Upload Script Ends here 
            */



    if($saved){
        
        [$status, $message] = ['success', 'Inventory updated successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, Inventory could not be updated.'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }

}


?>