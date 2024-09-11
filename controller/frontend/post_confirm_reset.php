<?php

/**
 * One framework
 * Author: Lamidi Ismaila
 * Email: dgoldenone@gmail.com
 */

require "config.php";

use Classes\Validate;
use Classes\Input;
use Classes\Token;
use Classes\Session;
use Classes\Redirect;
use Classes\Message;
use Classes\Log;
use Database\Models\Reset;
use Database\Models\User as UserModel;


if(Input::exists()){


    if(Token::check(Input::get('token'))){

        
            $ema = Input::get('email');


            $email = UserModel::where('email', '=', $ema)->first();
            $email_check = UserModel::where('email', '=', $ema)->get();


             if($email_check->count()>0){

                $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $pass_token = substr(str_shuffle($chars), 0, 7);

                Reset::insert(
                    [
                        'user_id' => $email->id, 
                        'token'   => $pass_token
                    ]
                );

                $tk = 'https://fmcs.com.ng/confirm_password/tk=';
                $url = $tk.$pass_token;
                $to        = $email;
                $subject   = "FMCS Password Reset";
                $message   = "Greetings...,\n You have requested a password reset. \n Please Delete this message if you did not initiate it.\n Otherwise, click on the link below to set a new password. \n ".$url;
                $headers   = "From: info@fmcs.com.ng";
                
                echo $message;
                exit;

                mail( $to, $subject, $message, $headers);
    
                Session::flash('sent', 'Please check your official email account for further instruction.');
                 
             }else{
                 echo "Email does not exits";
                 exit;
             }


    }
}else {
    Redirect::to('login');
}
$password = Session::exists('password');
exit();











?>
