<?php
require "config.php";
require_once 'twig.php';

use Classes\Config;
use Classes\Permissions;
use Classes\Redirect;
use Database\Models\Users as UserModel;
use Classes\User;
use Classes\Session;
use Classes\Token;
use Database\Models\Employees;
use Database\Models\Offices;

$user = new User();
$sessionName= Config::get('session/session_name');
$id         = Session::get($sessionName);
$userc      = UserModel::where('id', '=', $id)->first();
$role       = Permissions::get_role($id);
$current_user = Employees::where('ippis', '=', $userc['ippis'])->first();

if($user->isLoggedIn()){

    
    $sessionName= Config::get('session/session_name');
    $id         = Session::get($sessionName);
    $userc      = UserModel::where('id', '=', $id)->first();
    $token      = Token::generate();

    $offices = Offices::all()->sortBy('name');
   
    echo $twig->render('backend/admin/sites.html.twig', [
        'title'         => 'Department/Unit',
        'userc'         => $userc,
        'offices'       => $offices,
        'token'         => $token,
        'role'          => $role,
        'current_user'  => $current_user,        
        ]);


}else{
    Redirect::to('home');
}

?>