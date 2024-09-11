<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Classes\StaffHistory;
use Classes\Token;
use Database\Models\LeaveHistory;
use Database\Models\Users;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);
$cuser = Users::where('id', '=', $uid)->first('ippis')->toArray(); 

$current_user = $cuser['ippis'];

$user = new User();
if($user->isLoggedIn() && Token::check(Input::get('token'))){

        $ippis       = Sanitize::sanitize(Input::get('ippis'));
        $leave_type  = Sanitize::sanitize(Input::get('leave_type'));
        $start_date  = Sanitize::sanitize(Input::get('start_date'));
        $end_date    = Sanitize::sanitize(Input::get('end_date'));
        $days        = Sanitize::sanitize(Input::get('days'));
        $remark      = Sanitize::sanitize(Input::get('remark'));

        $saved = LeaveHistory::create([
            'ippis'      => $ippis,
            'leave_type' => $leave_type,
            'start_date' => $start_date,
            'end_date'   => $end_date,
            'days'       => $days,
            'remark'     => $remark,
            'request_status' => 'Pending'
        ]);

    if($saved){
        $description ='Leave created. Start on '.$start_date.' and end on '.$end_date;
        StaffHistory::log($ippis, 'Leave', $description, $current_user );
        [$status, $message] = ['success', 'Leave created successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, Leave could not be created'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }


}







?>