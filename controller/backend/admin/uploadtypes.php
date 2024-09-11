<?php
require "config.php";
require_once 'twig.php';

use Carbon\Traits\Timestamp;
use Classes\Config;
use Classes\Permissions;
use Classes\Redirect;
use Database\Models\Users as UserModel;
use Classes\User;
use Classes\Session;
use Database\Models\DocumentTypes;
use Database\Models\Employees;

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

    $docs = DocumentTypes::all();
   
    echo $twig->render('backend/admin/uploadtypes.html.twig', [
        'title'        => 'Upload Types',
        'userc'        => $userc,
        'docs'         => $docs,
        'role'         => $role,
        'current_user' => $current_user,        
        ]);


}else{
    Redirect::to('home');
}

?>