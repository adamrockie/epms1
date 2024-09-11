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
use Classes\Sanitize;
use Database\Models\Reset;
use Database\Models\User as UserModel;


if(Input::exists()){


    if(Token::check(Input::get('token'))){

            $ema   = Sanitize::sanitize(Input::get('email'));

            $email = UserModel::where('email', '=', $ema)->first();
            $email_check = UserModel::where('email', '=', $ema)->get();
            $firm_name = $email->firm_name;

             if($email_check->count()>0){

                $chars      = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $pass_token = substr(str_shuffle($chars), 0, 24);

                Reset::insert(
                    [
                        'user_id' => $email->id, 
                        'token'   => $pass_token
                    ]
                );

                $mail = new PHPMailer;

                $tk = 'https://iuserv2.appline.com.ng/reset?cd=';
                $link = $tk.$pass_token;

                $template = file_get_contents('email_templates/reset.html');

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
                $mail->addAddress($ema, $firm_name);     // Add a recipient
                $mail->addReplyTo('info@nae.org.ng', 'NAE Secretariat');
                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = 'Reset your NAE account password';
                $mail->Body    = $message;
                $mail->AltBody = "Welcome to the Nigeria Academy of Engineering. You have requested for password reset.
                
                If you didn't create the account , simply ignore this email otherwise click this link ".$link." to reset your account";

                if(!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'Message has been sent';
                }
    
                Session::flash('sent', 'Please check your email address for further instruction.');
                Redirect::to('passwordreset');
                 
             }else{
                 Session::flash('nomail', 'Email does not exits');
                 Redirect::to('passwordreset');
             }


    }
}else {
    Redirect::to('login');
}
$password = Session::exists('password');
exit();











?>
