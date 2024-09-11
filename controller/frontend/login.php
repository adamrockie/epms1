<?php
require "config.php";
require_once 'twig.php';

use Classes\Message;
use Classes\Session;
use Database\Models\User;
use Classes\Token;

$token = Token::generate();

// Recaptcha Keys 
$siteKey = '6LcvSPAaAAAAAAoVh1gqcth1-KIVXsoOe1pRGSgm';
$secret = '6LcvSPAaAAAAAHnhoGcF8FiPLJOWzOcXLHbQr-8U';

// $siteKey = '6LfIxj8iAAAAAAQyN6Grvgpcyn779zaCp-OtSVWF';
// $secret  = '6LfIxj8iAAAAAJxH68wxK0ava3rUcHrMXJhqtNs4';

$auth = '';
$account_created = '';
$verification = '';
$verification_failed = '';
$reset_success = '';

if(Session::exists('auth')){
    $auth = Session::get('auth');
    Session::delete('auth');
}

/*
if(Session::exists('account_created')){
    $account_created = Session::get('account_created');
    Session::delete('account_created');
}

if(Session::exists('verification')){
    $verification = Session::get('verification');
    Session::delete('verification');
}

if(Session::exists('verification_failed')){
    $verification_failed = Session::get('verification_failed');
    Session::delete('verification_failed');
}
*/

if(Session::exists('reset_success')){
    $reset_success = Session::get('reset_success');
    Session::delete('reset_success');
}


echo $twig->render('frontend/login.html.twig', [
    'token'             =>  $token,
    'title'             => 'Home',
    'auth'              => $auth,
    'account_created'   => $account_created,
    'verified'          => $verification,
    'verification_failed'=> $verification_failed,
    'reset_success'     => $reset_success,
    'sitekey'           => $siteKey
    ]);



?>