<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Permissions;
use Classes\Sanitize;
use Database\Models\Training;
use Database\Models\Users as UserModel;

$sessionName= Config::get('session/session_name');
$id         = Session::get($sessionName);
$userc      = UserModel::where('id', '=', $id)->first();
$role       = Permissions::get_role($id);




$user = new User();
if($user->isLoggedIn() && $role == 'Superuser'){

    
    $training_id  = Sanitize::sanitize(Input::get('training_id'));

    $delete = Training::where('id', '=', $training_id)->delete();

    if($delete){
        
        [$status, $message] = ['success', 'Training deleted successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, training could not be deleted'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }
}


?>