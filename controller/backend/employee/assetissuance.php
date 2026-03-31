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
use Database\Models\Employees;
use Database\Models\Offices;
use Database\Models\Ranks;
use Database\Models\States;
use Database\Models\ItemRequests;

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

    $total_requests = ItemRequests::where('status', 'pending')->count();
    $total_approved = ItemRequests::where('status', 'approve')->count();
    $total_reject = ItemRequests::where('status', 'reject')->count();
    $all_item_requests = ItemRequests::with('staff')->get();

    echo $twig->render('backend/employee/assetissuance.html.twig', [
        'title'     => 'Employees List',
        'userc'     => $userc,
        'token'     => $token,
        'role'         => $role,    
        'total_requests'    => $total_requests,
        'total_approved'    => $total_approved, 
        'total_rejects'    => $total_reject,
        'all_requests'    => $all_item_requests,
        'current_user' => $current_user,      
        ]);
}else{
    Redirect::to('home');
}

?>