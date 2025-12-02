<?php
require "config.php";
require_once 'twig.php';

use Carbon\Traits\Timestamp;
use Classes\ApiCalls;
use Classes\Config;
use Classes\Permissions;
use Classes\Redirect;
use Database\Models\Users as UserModel;
use Classes\User;
use Classes\Token;
use Classes\Session;


$user = new User();
$sessionName  = Config::get('session/session_name');
$id           = Session::get($sessionName);
$userc        = UserModel::where('id', '=', $id)->first();
$role         = Permissions::get_role($id);


if($user->isLoggedIn()){

    
    $sessionName= Config::get('session/session_name');
    $id         = Session::get($sessionName);
    $userc      = UserModel::where('id', '=', $id)->first();

    $token = Token::generate();
    $pending_requests = ApiCalls::getallrequests();
     
    echo $twig->render('backend/requests/pending_requests.html.twig', [
        'title'     => 'Pending Requests',
        'userc'     => $userc,
        'token'     => $token,
        'role'      => $role,
        'requests'  => $pending_requests,
        ]);
}else{
    Redirect::to('home');
}

?>