<?php
require "config.php";
require_once 'twig.php';

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Permissions;
use Database\Models\Inventory;
use Classes\Redirect;
use Classes\Token;
use Database\Models\Employees;
use Database\Models\Users as UserModel;

$user = new User();

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

  
$inventory_id = $_GET['id'] ?? null;

if(!$inventory_id){
    die("Invalid Inventory ID");
}

$item = Inventory::where('id', $inventory_id)->first();

if(!$item){
          Redirect::to('inventory');
}

    echo $twig->render('backend/employee/view_inventory.html.twig', [
        'title' => 'View Inventory',
        'item'  => $item,
        'current_user' => $current_user,
        'role'          => $role,
    ]);
} else {
    Redirect::to('home');
}