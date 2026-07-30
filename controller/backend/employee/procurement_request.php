<?php
require "config.php";
require_once 'twig.php';

use Classes\Config;
use Classes\Permissions;
use Classes\Redirect;
use Database\Models\Users as UserModel;
use Classes\User;
use Classes\Token;
use Classes\Session;
use Database\Models\Employees;
use Database\Models\RequestItems;

$user = new User();
$sessionName  = Config::get('session/session_name');
$id           = Session::get($sessionName);
$userc        = UserModel::where('id', '=', $id)->first();
$role         = Permissions::get_role($id);
$current_user = Employees::where('ippis', '=', $userc['ippis'])->first();

if ($user->isLoggedIn()) {

    $token = Token::generate();


   $my_requests = RequestItems::orderBy('id', 'desc')->get();

    $total_requests = $my_requests->count();
    $total_approved = $my_requests->where('status', 'approve')->count();
    $total_pending  = $my_requests->where('status', 'pending')->count();
    $total_rejected = $my_requests->where('status', 'reject')->count();

    echo $twig->render('backend/employee/procurement_request.html.twig', [
        'title'          => 'Procurement Request',
        'userc'          => $userc,
        'my_requests'    => $my_requests,
        'total_requests' => $total_requests,
        'total_approved' => $total_approved,
        'total_pending'  => $total_pending,
        'total_rejected' => $total_rejected,
        'token'          => $token,
        'role'           => $role,
        'current_user'   => $current_user,
    ]);
} else {
    Redirect::to('home');
}

?>