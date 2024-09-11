<?php
require "config.php";
require_once 'twig.php';

use Classes\Config;
use Classes\Permissions;
use Classes\Redirect;
use Database\Models\Users as UserModel;
use Classes\User;
use Classes\Session;
use Database\Models\Documents;
use Database\Models\Employees;

$user = new User();

if($user->isLoggedIn()){

    $sessionName= Config::get('session/session_name');
    $id         = Session::get($sessionName);
    $userc      = UserModel::where('id', '=', $id)->first();
    $role       = Permissions::get_role($id); 
    

    if($role == 'Superuser'){
        $documents = Employees::where('ippis', '=', $ssid)->get()->toArray();
        $surname = $documents[0]['surname'];
        $lastname = $documents[0]['lastname'];
        $middlename = $documents[0]['middlename']; 
        $filename   =   $surname.'_'.$middlename.'_'.$lastname.'.zip';
        $fileQry    =  Documents::where('ippis', '=', $ssid)->with('owner')->with('type')->get()->toArray();
        $files = array();
        $zip = new ZipArchive;
        if ($zip->open($filename,  ZipArchive::CREATE)){
            foreach ($fileQry as $key => $doc) {
                $files[$doc['title']] = $doc['doc'];
                $extension = explode('.', $doc['doc']);
                //echo getcwd().'/'.'uploads/documents/'.$doc['doc'],$doc['title'].'.'.$extension[1];
                //exit; 
                $path = getcwd().'/'.'uploads/documents/'.$doc['doc'];
                $file_name = $doc['title'].'.'.$extension[1];
                $zip->addFile($path, $file_name);
                //$zip->addFile(getcwd().'/'.'uploads/documents/'.$doc['doc'] ,$doc['title'].'.'.$extension[1]);
                //$zip->addFile('C:\wamp64\www\epms/uploads/documents/326_7_1710.jpg', 'new title title.jpg');
            }
            $zip->close();
            header("Content-type: application/zip"); 
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-length: " . filesize($filename));
            header("Pragma: no-cache"); 
            header("Expires: 0"); 
            readfile("$filename");
            unlink($filename);
        }else{
        echo 'Failed!';
        }
    }else{

        Redirect::to('../404.html');
    }  
}else{
    Redirect::to('../404.html');
}

?>