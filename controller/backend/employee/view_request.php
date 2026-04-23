<?php
require "config.php";
require_once 'twig.php';

use Classes\Config;
use Classes\Permissions;
use Classes\Redirect;
use Classes\Session;
use Classes\Token;
use Classes\User;
use Database\Models\Users as UserModel;
use Database\Models\Employees;
use Database\Models\ItemRequests;


$user = new User();
$sessionName  = Config::get('session/session_name');
$id           = Session::get($sessionName);
$userc        = UserModel::where('id', '=', $id)->first();
$role         = Permissions::get_role($id);
$current_user = Employees::where('ippis', '=', $userc['ippis'])->first();


if ($user->isLoggedIn()) {


   $sessionName= Config::get('session/session_name');
    $id         = Session::get($sessionName);
    $userc      = UserModel::where('id', '=', $id)->first();

    $token = Token::generate(); 
    $sessionName = Config::get('session/session_name');
    $id = Session::get($sessionName);
   


    $userc = UserModel::where('id', '=', $id)->first();
    $current_user = Employees::where('ippis', '=', $userc['ippis'])->first();



   $request_id = $_GET['id'] ?? null;

  

    if (!$request_id) {
        Redirect::to('request');
    }

    // Fetch request + staff + item 
   
    $request = ItemRequests::with([
    'staff',
    'inventory'
    ])->where('id', $request_id)->first();

    if (!$request) {
        Redirect::to('request');
    }

    echo $twig->render('backend/employee/view_request.html.twig', [
        'title' => 'View Request',
        'request' => $request,
        'current_user' => $current_user,
        'role'          => $role,
    ]);

} else {
    Redirect::to('home');
}