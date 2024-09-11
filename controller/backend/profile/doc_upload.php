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
use Database\Models\Documents;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn() && Token::check(Input::get('token'))){

    $title       = Sanitize::sanitize(Input::get('title'));
    $description = Sanitize::sanitize(Input::get('description'));
    $type_id     = Sanitize::sanitize(Input::get('type_id'));
    $ippis       = Sanitize::sanitize(Input::get('ippis'));
    $doc         = 'null';
    $upload_status = '0';
    $random = rand(1,9999);

            /**
             * Upload Script Starts here
             */

            $file_name=null;
            $uploads = $_SERVER['DOCUMENT_ROOT']."/epms/uploads/documents/";

            /*
            if($_FILES){
                $validextensions = array("jpg", "jpeg", "png");
                $temporary  = explode(".", $_FILES["doc"]["name"]);            
                $file_extension  = end($temporary);
                    if ($_FILES["doc"]["error"] > 0) 
                    {
                       // echo "Return Code: " . $_FILES["passport"]["error"] . "<br/><br/>";
                       $upload_status = '0';
                    } else {
                                $temporary          = explode(".", $_FILES["doc"]["name"]);
                                $file_extension     = end($temporary);
                                
                                $file_name  = $ippis.'_'.$type_id.'_'.$random;

                                if(move_uploaded_file($_FILES["doc"]["tmp_name"], $uploads.$file_name.'.'.$file_extension)) {
                                    $doc = $file_name.'.'.$file_extension; 
                                    $upload_status = '1';
                                }         
                        }
            }
            */



            if ($_SERVER['REQUEST_METHOD'] == "POST")
            {

                $temporary          = explode(".", $_FILES["doc"]["name"]);
                $file_extension     = end($temporary);
                $file_name1  = $ippis.'_'.$type_id.'_'.$random;
                $file_name = $file_name1.'.'.$file_extension; 

                $file_type = $_FILES["doc"]["type"];
                $temp_name = $_FILES["doc"]["tmp_name"];
                $file_size = $_FILES["doc"]["size"];
                $error = $_FILES["doc"]["error"];
                if (!$temp_name) {
                    echo "ERROR: Please browse for file before uploading";
                    exit();
                }


                function compress_image($source_url, $destination_url, $quality) {
                    $info = getimagesize($source_url);
                    if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
                    elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
                    elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
                    imagejpeg($image, $destination_url, $quality);
                }

                if ($error > 0){
                    echo $error;
                }else if (($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png")){
                        if($file_size = $_FILES["doc"]["size"] > 1500000){
                            $compressed = compress_image($temp_name, $uploads.$file_name, 50);
                            $upload_status = '1';
                            $file_name = $file_name;

                        }else{

                            move_uploaded_file($_FILES["doc"]["tmp_name"], $uploads.$file_name);
                            $doc = $file_name.'.'.$file_extension; 
                            $upload_status = '1';
                            $file_name = $file_name;          
                        }
                    
                }else{
                    echo "Uploaded image should be jpg or gif or png.";
                }
            }

            /**
            * Upload Script Ends here 
            */


    

    if($upload_status == 1){

        $saved = Documents::insert([
            'title'       => $title,
            'description' => $description,
            'type_id'     => $type_id,
            'ippis'       => $ippis,
            'doc'         => $file_name
        ]);
    
        if($saved){
            
            [$status, $message] = ['success', 'Document uploaded successfully'];
            echo json_encode(['status'=>$status, 'msg'=>$message]);
    
        }else{
    
            [$status, $message] = ['error', 'An error occurred, document could not be uploaded, please try again.'];
            echo json_encode(['status'=>$status, 'msg'=>$message]);
        }
    

    }else{

        [$status, $message] = ['error', 'An error occurred in the uploaded image, document could not be uploaded, please try again.'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }

    

}






?>