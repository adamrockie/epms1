<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Database\Models\Training;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

    $training   = Sanitize::sanitize(Input::get('training'));
    $start_date = Sanitize::sanitize(Input::get('start_date'));
    $end_date   = Sanitize::sanitize(Input::get('end_date'));
    $certificate= Sanitize::sanitize(Input::get('certificate'));
    $url        = Sanitize::sanitize(Input::get('url'));
    $ippis      = Sanitize::sanitize(Input::get('sid'));
    $certificate         = 'null';
    $upload_status = '0';
    $random = rand(1,9999);
    $tt = date('h');

        /**
         * Upload Script Starts here
         */

            $file_name=null;
            $uploads = $_SERVER['DOCUMENT_ROOT']."/epms/uploads/certificates/";

            $temporary          = explode(".", $_FILES["certificate"]["name"]);
            $file_extension     = end($temporary);
            $file_name1  = $ippis.'_cert_'.$tt.$random;
            $file_name = $file_name1.'.'.$file_extension; 

            $file_type = $_FILES["certificate"]["type"];
            $temp_name = $_FILES["certificate"]["tmp_name"];
            $file_size = $_FILES["certificate"]["size"];
            $error = $_FILES["certificate"]["error"];
            if (!$temp_name) {
                echo "ERROR: Please browse for file before uploading";
                exit();
            }

            if ($error > 0){
                echo $error;
            }else if (($file_type == "image/jpg") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "application/pdf")){
                        move_uploaded_file($_FILES["certificate"]["tmp_name"], $uploads.$file_name);
                        $certificate = $file_name; 
                        //$upload_status = '1';
                        //$file_name = $file_name;                          
            }else{
                echo "Uploaded image should be jpg or jpeg or png or pdf";
            }

        /**
        * Upload Script Ends here 
        */

        $saved = Training::insert([
            'ippis'      => $ippis,
            'training'   => $training,
            'start_date' => $start_date,
            'end_date'   => $end_date,
            'certificate'=> $certificate,
            'url'        => $url
            
        ]);

    if($saved){
        
        [$status, $message] = ['success', 'Training details saved successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, Training details could not be added'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }
}


?>