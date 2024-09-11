<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Database\Models\Documents;
use Database\Models\NOK;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

    $title       = Sanitize::sanitize(Input::get('title'));
    $description = Sanitize::sanitize(Input::get('description'));
    $type_id     = Sanitize::sanitize(Input::get('type_id'));
    $ippis       = Sanitize::sanitize(Input::get('ippis'));
    $doc         = Sanitize::sanitize(Input::get('doc'));
    $id          = Sanitize::sanitize(Input::get('uid'));

             /**
             * Upload Script Starts here
             */

            $file_name=null;
            $uploads = $_SERVER['DOCUMENT_ROOT']."/epms/uploads/documents/";

            if($_FILES["doc"]["name"]){
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
                                
                                $file_name  = $ippis.'_'.$type_id;

                                if(move_uploaded_file($_FILES["doc"]["tmp_name"], $uploads.$file_name.'.'.$file_extension)) {
                                    $doc = $file_name.'.'.$file_extension; 
                                    $upload_status = '1';
                                }         
                        }

                        $saved = Documents::where('id', '=', $id)->update([
                            'title'       => $title,
                            'description' => $description,
                            'type_id'     => $type_id,
                            'ippis'    => $ippis,
                            'doc'         => $doc
                        ]);

            }else{
                $saved = Documents::where('id', '=', $id)->update([
                    'title'       => $title,
                    'description' => $description,
                    'type_id'     => $type_id,
                    'ippis'    => $ippis
                ]);
            }

            /**
            * Upload Script Ends here 
            */

    if($saved){
        
        [$status, $message] = ['success', 'Document details updated successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, Document details could not be updated'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }
}


?>