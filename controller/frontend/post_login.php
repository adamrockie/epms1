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
use Classes\User;
use Database\Models\User as UserModel;


if(Input::exists()){

    if(Token::check(Input::get('token'))){
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'email' => array('required' => true),
            'password' => array('required' => true)
            //'recaptcha'=> array('required' => true)
        ));

        if($validation->passed()){

            $user = new User();

            $remember = (Input::get('remember') === 'on') ? true : false;
            $login = $user->login(Input::get('email'), Input::get('password'), $remember);

            if($login){

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
                date_default_timezone_set('Africa/Lagos');

                // Log this action into the database
                $date = date('Y-m-d');
                $time = date('H:i:s');
                $logs = new Log;
                $logs->loggin(array(
                   'ip'      =>  $ip,
                   'user' =>  Input::get('username'),
                   'action'  => 'Login successfully',
                   "date"    => $date,
                   "time"    => $time,
                   'tlevel'  => 'Low'
                ));
*/


                Redirect::to('dashboard');

            }else{
                Session::flash('auth', 'Login failed. Email/Password not correct');
                Redirect::to('login');
            }
            

        }else{
            foreach($validation->errors() as $error){
                $message =  $error . '<br/>';
                $msg = new Message;
                $msg->setmessage($message);
            }
        }
    }
}else {
    Redirect::to('login');
}
$password = Session::exists('password');
exit();











?>
