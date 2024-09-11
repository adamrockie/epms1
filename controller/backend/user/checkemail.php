<?php

require "config.php";
require_once 'twig.php';

use Database\Models\Users as UserModel;
use Classes\User;


$user = new User();
        $email  = $_POST['email'];
        $email = UserModel::Where('email', '=', $email)->first();
       if($email){
           $email = 'true';
           echo $email;
       }else {
           $email = 'false';
           echo $email;
       };        
exit();

?>