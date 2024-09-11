<?php
require "config.php";
require_once 'twig.php';

use Classes\Session;
use Database\Models\Post;
use Database\Models\User;
use Classes\Token;

$sent = '';
$nomail = '';

if(Session::exists('sent')){
    $sent = Session::get('sent');
    Session::delete('sent');   
}

if(Session::exists('nomail')){
    $sent = Session::get('nomail');
    Session::delete('nomail');   
}

$token = Token::generate();


echo $twig->render('frontend/passwordreset.html.twig', [
    'token' =>  $token,
    'title' => 'Password Reset ',
    'sent'  => $sent,
    'nomail'=> $nomail
    ]);



?>