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
use Database\Models\Heads;
use Database\Models\Offices;

$user = new User();
$sessionName  = Config::get('session/session_name');
$id           = Session::get($sessionName);
$userc        = UserModel::where('id', '=', $id)->first();
$role         = Permissions::get_role($id);
$current_user = Employees::where('ippis', '=', $userc['ippis'])->first();

if($user->isLoggedIn()){

    
    $sessionName= Config::get('session/session_name');
    $id         = Session::get($sessionName);
    $userc      = UserModel::where('id', '=', $id)->first();

    $offices = Offices::all()->sortBy('name');
    $heads = Heads::all();
    $token = Token::generate();

    // All Staff details     
    
    $staff = Employees::all();
   
    echo $twig->render('backend/admin/view_staff.html.twig', [
        'title'         => 'View Staff',
        'userc'         => $userc,
        'token'         => $token,
        'offices'       => $offices,
        'employees'     => $staff,
        'heads'         => $heads,
        'role'          => $role,
        'current_user'  => $current_user,        
        ]);


}else{
    Redirect::to('home');
}

?>