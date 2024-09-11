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
use Database\Models\Units;
use Database\Models\Inventory;
use Database\Models\Receiveable;

$user = new User();

if($user->isLoggedIn()){

    
    $sessionName= Config::get('session/session_name');
    $id         = Session::get($sessionName);
    $user       = UserModel::where('id', '=', $id)->first();
    $userc      = UserModel::where('id', '=', $id)->first();
    $role       = Permissions::get_role($id);

    //$employees_num = Employees::all()->count();
    $employees_num  = Employees::where('status', '=', 'active')->count();
    $retired_num    = Employees::where('status', '=', 'retired')->count();
    $tinventory     = Inventory::all()->count();
    $tprojects      = Receiveable::all()->count();
    $unit_num       = Units::all()->count();
    $epms_user_num  = UserModel::all()->count();

    $c_user = UserModel::where('id', '=', $id)->first()->toArray();
    $current_user = Employees::where('ippis', '=', $c_user['ippis'])->first();

    if($current_user){
        $staff_name = $current_user['title'].' '.$current_user['surname'].' '.$current_user['lastname'];
    }else{
        $staff_name = '';
    }

    /**Permission and Role 
    $user_group = $c_user['group_id'];
    $role = Groups::where('id', '=', $user_group)->first()->toArray();

    $role = json_decode($role['permissions'], true);

    $check = array_key_exists('groups', $role);

    if($check){

        $permission = $role['groups'];

        $check_perm = array_key_exists('edit', $permission);

        if($check_perm){
            //echo '<script>window.location.href = "employees";</script>';
            echo 'permitted';
        }else{
            echo '<h1>You do not have permission to view this page</h1>';
        }

        exit;
    }

    /**End Permission and Role */

    $role = Permissions::get_role($id);
   // $perm =  Permissions::check($id, 'roles', 'delete');
   // var_dump($role);
   // exit;

    if($role == 'Superuser'){
       // $role = 'Super Admin';

    }elseif($role == 'Admin'){
       // $role = 'Admin';
    }else{
        Redirect::to('profile/'.$c_user['ippis']);
    }




    $token = Token::generate();
   
    echo $twig->render('backend/admin/dashboard.html.twig', [
        'token'             =>  $token,
        'title'             => 'Dashboard',
        'userc'             => $userc,
        'employees_num'     => $employees_num,
        'retired_num'       => $retired_num,
        'tinventory'        => $tinventory,
        'tprojects'         => $tprojects,
        'epms_user_num'     => $epms_user_num,
        'staff_name'        => $staff_name,
        'role'              => $role,
        'current_user'      => $current_user,

        ]);


}else{
    Redirect::to('home');
}

?>