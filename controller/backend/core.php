<?php

use Classes\Config;
use Classes\Permissions;
use Database\Models\Users as UserModel;
use Classes\Session;
use Classes\Staff;
use Database\Models\Notifications;

$sessionName= Config::get('session/session_name');
$id         = Session::get($sessionName);
$user       = UserModel::where('id', '=', $id)->first();
$userc      = UserModel::where('id', '=', $id)->first();
$role       = Permissions::get_role($id);

/** Get Current user details & Role */
$c_user = UserModel::where('id', '=', $id)->first()->toArray();
$current_user = Staff::getstaff($c_user['ippis']);
$current_user ? $staff_name = $current_user['title'].' '.$current_user['surname'].' '.$current_user['lastname'].' '.$current_user['middlename'] : $staff_name = '';
$role = Permissions::get_role($id);
$notifications = Notifications::where([['user_destination', '=', $role],['status', '=', 'unread']])->get();
$notif = $notifications->count();



?>