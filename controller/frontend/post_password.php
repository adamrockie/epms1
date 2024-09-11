<?php

/**
 * One framework
 * Author: Lamidi Ismaila
 * Email: dgoldenone@gmail.com
 */

require "config.php";

use Classes\Hash;
use Classes\Validate;
use Classes\Input;
use Classes\Token;
use Classes\Session;
use Classes\Redirect;
use Classes\Message;
use Classes\Sanitize;
use Database\Models\User as UserModel;


if(Input::exists()){


    if(Token::check(Input::get('token'))){
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'password' => array('required' => true),
            'password' => array('match' => 'confirm_password')  
        ));

        if($validation->passed()){

            $password    = Sanitize::sanitize(Input::get('password'));
            $uid         = Sanitize::sanitize(Input::get('uid'));
            $password    = Hash::make($password);

            $saved = UserModel::where('id', '=', $uid) 
            ->update(['password'=> $password]);

            Session::flash('reset_success', 'Password reset successfully.');
            Redirect::to('login');
            
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

exit();











?>
