<?php
require "config.php";
require_once 'twig.php';

use Classes\Token;
use Classes\Sanitize;
use Classes\Input;
use Classes\Session;
use Classes\Redirect;
use Database\Models\Reset;


$token = Token::generate();

$cd   = Sanitize::sanitize(Input::get('cd'));

$user = Reset::where('token', '=', $cd)->get();

if($user->count()>0){

    $userid = Reset::where('token', '=', $cd)->first();

    $uid = $userid['user_id'];

    Reset::where('token', '=', $cd)->delete();
    $token = Token::generate();

    echo $twig->render('frontend/confirm_password.html.twig', [
        'token' =>  $token,
        'title' => 'Set New Password ',
        'uid'  => $uid
        ]);


}else{

    Session::flash('verification_failed', 'Verification failed: Link is not valid or has expired');
    Redirect::to('login');

}



?>