<?php
require "config.php";
require_once 'twig.php';

use Database\Models\Post;
use Database\Models\User;
use Classes\Token;


$token = Token::generate();

//$post = Post::all();
//$user = User::where('email', '=', Input::get('email'));

 //NUser::where('email', '=', 'dgoldenone@gmail.com')->first();
 //$user = User::where('email', '=', 'dgoldenone@gmail.com')->first();


echo $twig->render('frontend/confirm_password.html.twig', [
    'token' =>  $token,
    'title' => 'Confirm Password ',
    'post'  => $post
    ]);



?>