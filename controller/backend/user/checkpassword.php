<?php

require "config.php";
require_once 'twig.php';

use Classes\Hash;
use Database\Models\Users as UserModel;
use Classes\User;


$ippis = $_POST['ippis'];
$current_password = $_POST['current_password'];

$user = new User();
        $user_details = UserModel::Where('ippis', '=', $ippis)->first();
        $current_p = $user_details['password'];


        if (password_verify($current_password, $current_p )) {
            $check = 'true';
            echo $check;
        } else {
            $check = 'false';
            echo $check;
        }
       
exit();

?>