<?php
require "config.php";
require_once 'twig.php';

use Classes\Session;
use Database\Models\Post;
use Database\Models\User;
use Classes\Token;

$error_created = '';

if(Session::exists('error_created')){
    $error_created = Session::get('error_created');
    Session::delete('error_created');
    
}

$token = Token::generate();

echo $twig->render('frontend/register.html.twig', [
    'token' =>  $token,
    'title' => 'Register',
    'error_created'  => $error_created
    ]);



?>