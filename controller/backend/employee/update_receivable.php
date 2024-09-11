<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Database\Models\Receiveable;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);


$user = new User();
if($user->isLoggedIn()){

    $id                         = uniqid();
    $contract                   = Sanitize::sanitize(Input::get('contract'));
    $contractor                 = Sanitize::sanitize(Input::get('contractor'));
    $lot_number                 = Sanitize::sanitize(Input::get('lot_number'));
    $status                     = Sanitize::sanitize(Input::get('status'));
    $email                      = Sanitize::sanitize(Input::get('email'));
    $phone_number               = Sanitize::sanitize(Input::get('phone_number'));
    $date                       = Sanitize::sanitize(Input::get('date'));
    $upload                     = Sanitize::sanitize(Input::get('upload'));
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
                                    $upload = $file_name.'.'.$file_extension; 
                                    $upload_status = '1';
                                }         
                        }

                        $saved = Receiveable::where('id', '=', $id)
                        ->update([
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
                $saved = Receiveable::where('id', '=', $id)
                ->update([
                    'contract'              => $contract,
                    'contractor'            => $contractor,
                    'lot_number'            => $lot_number,
                    'status'                => $status,
                    'email'                 => $email,
                    'phone_number'          => $phone_number,
                    'date'                  => $date,
                    'upload'                => $upload,
                ]);
               
            }

            /**
            * Upload Script Ends here 
            */



    if($saved){
        
        [$status, $message] = ['success', 'Contract information updated successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, contract information could not be updated.'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }

}


?>