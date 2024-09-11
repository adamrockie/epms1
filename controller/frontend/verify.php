<?php
require "config.php";
require_once 'twig.php';

use Database\Models\Post;
use Database\Models\User as UserModel;
use Classes\Token;
use Classes\Sanitize;
use Classes\Input;
use Classes\Session;
use Classes\Redirect;


$token = Token::generate();

$cd   = Sanitize::sanitize(Input::get('cd'));

$user = UserModel::where('verify', '=', $cd)->get();

if($user->count()>0){

    UserModel::where('verify', '=', $cd)
    ->update(
        [
            'verify' => '', 
            'status' => 'active'
        ]
    );

    Session::flash('verification', 'Verification successful: Your email address has been verified');
    Redirect::to('login');

}else{

    Session::flash('verification_failed', 'Verification failed: Link is not valid or has expired');
    Redirect::to('login');

}


/*
echo $twig->render('frontend/login.html.twig', [
    'token' =>  $token,
    'title' => 'Confirm Password ',
    ]);
*/


?>