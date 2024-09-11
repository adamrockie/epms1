<?php
require "config.php";
require_once 'twig.php';

use Classes\Redirect;
use Database\Models\Post;
use Database\Models\User as UserModel;
use Classes\User;
use Classes\Session;
use Classes\Token;
use Classes\Config;

$user = new User();

if($user->isLoggedIn()){


        $sessionName = Config::get('session/session_name');
        $sid = Session::get($sessionName);
        $userc = UserModel::where('id', '=', $sid)->first();

        $token = Token::generate();

        $user = UserModel::Where('id', '=', $id)->first();


        echo $twig->render('backend/edituser.html.twig', [
            'title'     => 'Edit User',
            'user'      => $user,
            'userc'     => $userc,
            'token'     => $token
            ]);

}else{
    Redirect::to('home');
}

?>