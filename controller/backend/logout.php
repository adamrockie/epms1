<?php
require "config.php";
require_once 'twig.php';

use Database\Models\Post;
use Database\Models\User as ModelUser;
use Classes\User;
use Classes\Token;
use Classes\Config;
use Classes\Session;
use Classes\Redirect;


//$user = User::where('email', '=', Input::get('email'));

 //NUser::where('email', '=', 'dgoldenone@gmail.com')->first();
 //$user = User::where('email', '=', 'dgoldenone@gmail.com')->first();


 $userc = new User();

 /*
 function getUserIpAddr(){
     if(!empty($_SERVER['HTTP_CLIENT_IP'])){
         //ip from share internet
         $ip = $_SERVER['HTTP_CLIENT_IP'];
     }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
         //ip pass from proxy
         $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
     }else{
         $ip = $_SERVER['REMOTE_ADDR'];
     }
     return $ip;
 }
 $ip = getUserIpAddr();
 */

 //$sessionName = Config::get('session/session_name');
 //$user = Session::get($sessionName); 

// $check = Session::exists($sessionName);
//var_dump($check);
//exit;
 
 //$user_data = $userc->sessionfind($user);
 
 /*
 // Log this action into the database
 date_default_timezone_set('Africa/Lagos');
 //$user = $user_data->username;
 $date = date('Y-m-d');
 $time = date('H:i:s');
 $logs = new Log;
 $logs->loggin(array(
    'ip'      =>  $ip,
    'user' =>  $user,
    'action'  => 'Logout',
    "date"    => $date,
    "time"    => $time,
    'tlevel'  => 'Low'
 ));
 */
 $userc->logout();
 
 Redirect::to('login');


?>