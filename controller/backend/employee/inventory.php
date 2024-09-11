<?php
require "config.php";
require_once 'twig.php';

use Carbon\Traits\Timestamp;
use Classes\Config;
use Classes\Permissions;
use Classes\Redirect;
use Database\Models\Users as UserModel;
use Classes\User;
use Classes\Token;
use Classes\Session;
use Database\Models\Employees;
use Database\Models\Offices;
use Database\Models\Ranks;
use Database\Models\States;
use Database\Models\Inventory;

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

    $token = Token::generate();
    
    $inventory      = Inventory::all();
    $issued         = count(Inventory::where('status', '=', 'issued')->get());
    $nissued        = count(Inventory::where('status', '=', 'notissued')->get());
    $tinventory     = count($inventory);
 
    echo $twig->render('backend/employee/inventory.html.twig', [
        'title'         => 'Inventory',
        'userc'         => $userc,
        'inventory'     => $inventory,
        'tinventory'    => $tinventory,
        'issued'        => $issued,
        'nissued'       => $nissued,
        'token'         => $token,
        'role'          => $role,
        'current_user'  => $current_user,      
        ]);
}else{
    Redirect::to('home');
}

?>