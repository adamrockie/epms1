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
use Classes\Sanitize;
use Classes\Hash;
use Database\Models\User as UserModel;


if(Input::exists()){

    if(Token::check(Input::get('token'))){
        

        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'email'     => array('required' => true),
            'password'  => array('match' => 'confirm_password')       
        ));

        if($validation->passed()){
           
            $email       = Sanitize::sanitize(Input::get('email')); 
            $password    = Sanitize::sanitize(Input::get('password'));
            $role        = Sanitize::sanitize(Input::get('role'));

            $password    = Hash::make($password);
            $chars  = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $verify = substr(str_shuffle($chars), 0, 24);
            
            if(!$role){
                $role = 'member';
            }

            if(!$status){
                $status = 'disabled';
            }

            $saved = UserModel::insert(
                [
                    'email'      => $email,
                    'role'       => $role,
                    'status'     => $status,
                    'password'   => $password,
                    'verify'     => $verify
                ]
            );

            if($saved){

                $mail = new PHPMailer;

                $tk = 'https://iuserv2.appline.com.ng/verify?cd=';
                $link = $tk.$verify;

                $template = file_get_contents('email_templates/activate.html');

                $message  = str_replace("linkzzz", "$link", $template); 


                //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'dgoldenone@gmail.com';                 // SMTP username
                $mail->Password = '!sma###l@1sT!!';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                $mail->setFrom('info@nae.org.ng', 'Nigeria Academy of Engineering');
                $mail->addAddress($email, $names);     // Add a recipient
                //$mail->addAddress('ellen@example.com');               // Name is optional
                $mail->addReplyTo('info@nae.org.ng', 'NAE Secretariat');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = 'Activate your Iuser account';
                $mail->Body    = $message;
                $mail->AltBody = "Welcome to Iuser. An account has been created on our website using this email.
                
                If you didn't create the account , simply ignore this email otherwise click this link ".$link." to activate your account";

                //$mail->addAttachment('email_templates/activate/images/logo.jpg');

                if(!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'Message has been sent';
                }
                
                Session::flash('account_created', 'Account created successfully, Please check your email for further instructions.');
                Redirect::to('login');

            }else{
              
                Session::flash('error_created', 'Sorry!, Account could not be saved');
                Redirect::to('register');
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
