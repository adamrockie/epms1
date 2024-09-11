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
use Database\Models\Modules;
use Database\Models\Offices;

$user = new User();



//$user_class->haspermission('Superuser');
//
//

if($user->isLoggedIn()){

        $sessionName = Config::get('session/session_name');
        $id = Session::get($sessionName);

        // Get the user's Group (Role) and Permissions from the Session variable
        //$user = UserModel::where('id', $id)->with('group')->get()->toArray();
        //print_r($user[0]['group']['permissions']);
        //print_r(json_decode($user[0]['group']['permissions'])); 
        //exit;
        
        //This is the format of the permissions array that will be saved in the database as JSON

/*        
        $sample = [
            'access' => [

                'module_name' => [
                    'permission_name' => true
                ],

                'users' => [
                    'view' => true,
                    'create' => true,
                    'edit' => true,
                    'delete' => true
                ],
                'groups' => [
                    'view' => true,
                    'create' => true,
                    'edit' => true,
                    'delete' => true
                ],
                'offices' => [
                    'view' => true,
                    'create' => true,
                    'edit' => true,
                    'delete' => true
                ],
                'employees' => [
                    'view' => true,
                    'create' => true,
                    'edit' => true,
                    'delete' => true
                ],
                'roles' => [
                    'view' => true,
                    'create' => true,
                    'edit' => true,
                    'delete' => true
                ],
                'permissions' => [
                    'view' => true,
                    'create' => true,
                    'edit' => true,
                    'delete' => true
                ]
            ]
        ];

        var_dump(json_encode($sample));
        echo "<hr>";
        print_r(json_encode($sample));
        exit;
        */


        //$user->haspermission('Superuser');

        $user  = UserModel::where('id', '=', $id)->first();
        $token = Token::generate();
        $user = new User();
        $sessionName  = Config::get('session/session_name');
        $id           = Session::get($sessionName);
        $userc        = UserModel::where('id', '=', $id)->first();
        $role         = Permissions::get_role($id);
        $current_user = Employees::where('ippis', '=', $userc['ippis'])->first();

        $employees = Employees::all()->sortBy('names');
        $groups  = Groups::all()->sortBy('name');
        $offices = Offices::all();
        $users   = UserModel::get();
        $modules = Modules::get()->sortBy('module_name');



        echo $twig->render('backend/role/roles.html.twig', [
            'token'    =>  $token,
            'title'    => 'Manage Roles and Permissions',
            'user'     => $user,
            'token'    => $token,
            'userc'    => $userc,
            'employees'=> $employees,
            'roles'    => $groups,
            'offices'  => $offices,
            'modules'  => $modules,
            'users'    => $users,
            'role'         => $role,
            'current_user' => $current_user, 
            ]);


}else{
    Redirect::to('home');
}

?>