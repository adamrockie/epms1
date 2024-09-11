<?php
require "config.php";
require_once 'twig.php';

use Classes\Redirect;
use Database\Models\Users as UserModel;
use Classes\User;
use Classes\Session;
use Classes\Token;
use Classes\Config;

$user = new User();

if($user->isLoggedIn()){
        
        $sessionName = Config::get('session/session_name');
        $id = Session::get($sessionName);
        $userc = UserModel::where('id', '=', $id)->first();

        $user = UserModel::all();
        $token = Token::generate();

        echo $twig->render('backend/userlist.html.twig', [
            'token' => $token,
            'title' => 'User List',
            'users' => $user,
            'userc' => $userc,
            ]);


}else{
    Redirect::to('home');
}

?>