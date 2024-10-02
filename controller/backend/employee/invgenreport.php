<?php
require "config.php";
require_once 'twig.php';

use Classes\Config;
use Classes\Input;
use Classes\Permissions;
use Classes\Session;
use Classes\User;
use Database\Models\Employees;
use Database\Models\Inventory;
use Database\Models\Users as UserModel;

$user = new User();

$user = new User();
$sessionName  = Config::get('session/session_name');
$id           = Session::get($sessionName);
$userc        = UserModel::where('id', '=', $id)->first();
$role         = Permissions::get_role($id);
$current_user = Employees::where('ippis', '=', $userc['ippis'])->first(); 

if($user->isLoggedIn()){

    $selected = $_POST;

for ($i=0; $i < count($selected)+6; $i++) { 
    if (($key = array_search('', $selected)) !== false) {
        unset($selected[$key]);
    }
    unset($selected['category']);
    unset($selected['token']);
}

    $searchmap = array();
    foreach ($selected as $key => $value) {
        $searchmap[$key] = $value;
    } 
    
    $response = Inventory::whereNested(function($query) use ($searchmap)
        {
            foreach ($searchmap as $key => $value)
            {
                if($key == 'from'){
                    if($value == ''){
                        $query->where('date', '>=', '1980-01-01');
                    }else{
                        $query->where('date', '>=', $value);
                    }
                }elseif ($key == 'to') {
                    if($value == ''){
                        $query->where('date', '<=', date('Y-m-d'));
                    }else{
                        $query->where('date', '<=', $value);
                    }
                }elseif($key == 'inventory_name'){
                    if($value == ''){
                        $query->where('inventory', 'like', '%');
                    }else{
                        $query->where('inventory', 'like', '%'.$value.'%');
                    }
                }elseif($key == 'amount'){
                    if($value == ''){
                        $query->where('amount', '=', $value);
                    }else{
                        $query->where('amount', '=', $value);
                    }
                }elseif($key == 'status'){
                    if($value == ''){
                        $query->where('status', '=', $value);
                    }else{
                        $query->where('status', '=', $value);
                    }
                }else{
                    $query->where($key, '=', $value); 
                }
            }
        } )->get()->toArray();

        echo $twig->render('backend/employee/invresults.html.twig', [
            'title'         => 'Generated Report',
            'role'          => $role,
            'userc'         => $userc,
            // 'notif'         => $notif,
            // 'notifications' => $notifications,
    
            'responses'    => $response
            
            ]);

}


?>