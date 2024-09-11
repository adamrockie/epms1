<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Classes\Token;
use Database\Models\Posting;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);


$user = new User();
if($user->isLoggedIn() && Token::check(Input::get('token'))){

    $office_id = Sanitize::sanitize(Input::get('new_office_id'));
    $unit_id   = Sanitize::sanitize(Input::get('new_unit_id'));
    $staff_id  = Sanitize::sanitize(Input::get('staff_id'));
    $start_date= date("Y-m-d");   
    $end_date  = date("Y-m-d");
    $posting_id= rand(100, 99999).date('hms');

    $saved = Posting::create([
        'ippis'    => $staff_id,
        'office_id'   => $office_id,
        'unit_id'     => $unit_id,
        'start_date'  => $start_date,
        'posting_id'  => $posting_id,
        'status'      => 'Pending'
    ]);

    if($saved){
        
        [$status, $message] = ['success', 'Posting done successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, Posting could not be added'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }
}






?>