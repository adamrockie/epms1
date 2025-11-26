<?php
require "config.php";
require_once 'twig.php';

use Classes\Config;
use Classes\Input;
use Classes\Permissions;
use Classes\Session;
use Classes\User;
use Database\Models\Employees;
use Database\Models\Users as UserModel;
use Database\Models\Receiveable;

$user = new User();
$sessionName  = Config::get('session/session_name');
$id           = Session::get($sessionName);
$userc        = UserModel::where('id', '=', $id)->first();
$role         = Permissions::get_role($id);
$current_user = Employees::where('ippis', '=', $userc['ippis'])->first();

if($user->isLoggedIn()){

    $selected = $_POST;

    // CLEAN EMPTY VALUES
    foreach ($selected as $key => $value) {
        if ($value === '' || $key == 'token') {
            unset($selected[$key]);
        }
    }

    
    $searchmap = $selected;


    $response = Receiveable::whereNested(function($query) use ($searchmap)
    {
      //  Date range filter (from select)
    if (!empty($searchmap['from']) && !empty($searchmap['to'])) {
        $start = date('Y-m-d', strtotime($searchmap['from']));
        $end   = date('Y-m-d', strtotime($searchmap['to']));

        $query->whereBetween('date', [$start, $end]);
    }
    elseif (!empty($searchmap['from'])) {
        $query->where('date', '>=', date('Y-m-d', strtotime($searchmap['from'])));
    }
    elseif (!empty($searchmap['to'])) {
        $query->where('date', '<=', date('Y-m-d', strtotime($searchmap['to'])));
    }

    //  Contractor filter (from select)
    if (!empty($searchmap['contractor'])) {
        $contractor = trim($searchmap['contractor']);
        $query->where('contractor', '=', $contractor);
    }

    // status or other fields
    foreach ($searchmap as $key => $value) {
        if (in_array($key, ['from','to','contractor'])) continue;
        if ($value === '') continue;
        $query->where($key, '=', $value);
    }

})->get()->toArray();
   
    echo $twig->render('backend/employee/recresults.html.twig', [
        'title'      => 'Generated Report',
        'userc'      => $userc,
        'role'       => $role,
        // 'notif'         => $notif,
        // 'notifications' => $notifications,
        'responses'  => $response
    ]);
}







?>