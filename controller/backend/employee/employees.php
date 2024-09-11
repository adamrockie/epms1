<?php
require "config.php";
require_once 'twig.php';

use Carbon\Traits\Timestamp;
use Classes\Config;
use Classes\Redirect;
use Database\Models\Users as UserModel;
use Classes\User;
use Classes\Token;
use Classes\Session;
use Database\Models\Offices;

$user = new User();

if($user->isLoggedIn()){

    
    $sessionName= Config::get('session/session_name');
    $id         = Session::get($sessionName);
    $userc      = UserModel::where('id', '=', $id)->first();

    $offices = Offices::all();
   
    echo $twig->render('backend/employee/employees.html.twig', [
        'title'             => 'Employees',
        'userc'             => $userc,
        'offices'           => $offices,        
        ]);


}else{
    Redirect::to('home');
}

?>