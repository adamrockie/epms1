<?php
require "config.php";
require_once 'twig.php';

use Classes\Redirect;
use Database\Models\Users as UserModel;
use Classes\User;
use Classes\Session;
use Classes\Token;
use Classes\Config;
use Classes\Permissions;
use Database\Models\Employees;
use Database\Models\Groups;
use Database\Models\Offices;

$user = new User();

if($user->isLoggedIn()){

        // $sessionName = Config::get('session/session_name');
        // $id = Session::get($sessionName);
        // $user = UserModel::where('id', '=', $id)->first();
        // $userc = UserModel::where('id', '=', $id)->first();
        $token = Token::generate();

        $user = new User();
        $sessionName  = Config::get('session/session_name');
        $id           = Session::get($sessionName);
        $userc        = UserModel::where('id', '=', $id)->first();
        $role         = Permissions::get_role($id);
        $current_user = Employees::where('ippis', '=', $userc['ippis'])->first();
        

        $employees = Employees::all()->sortBy('surname');
        $groups = Groups::all();
        $offices = Offices::all();
        $users = UserModel::get();

        echo $twig->render('backend/user/users.html.twig', [
            'token'    =>  $token,
            'title'    => 'Users',
            'user'     => $user,
            'token'    => $token,
            'userc'    => $userc,
            'employees'=> $employees,
            'roles'    => $groups,
            'offices'  => $offices,
            'users'    => $users,
            'role'         => $role,
            'current_user' => $current_user, 
            'userc'     => $userc,
            ]);


}else{
    Redirect::to('home');
}

?>