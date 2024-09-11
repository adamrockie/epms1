<?php
require "config.php";


use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Classes\Token;
use Database\Models\Heads;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn() && Token::check(Input::get('token'))){

    $ippis      = Sanitize::sanitize(Input::get('staff'));
    $office_id  = Sanitize::sanitize(Input::get('site'));
    $status     = 'active';
    $doa        = date('Y-m-d');

    $check_dept = Heads::where([['office_id', '=', $office_id], ['status', '=', 'active']])->get();//->update(['status' => 'inactive']);
    $check_staff = Heads::where([['ippis', '=', $ippis], ['status', '=', 'active']])->get();//->update(['status' => 'inactive']);

    if($check_dept->count() > 0){
        Heads::where([['office_id', '=', $office_id], ['status', '=', 'active']])->update([
            'status' => 'transffered',
            'dot'    => $doa
        ]);
    }

    if($check_staff->count() > 0){
        Heads::where([['ippis', '=', $ippis], ['status', '=', 'active']])->update([
            'status' => 'transffered',
            'dot'    => $doa
        ]);
    }

    $saved = Heads::create([
        'ippis'     => $ippis,
        'office_id' => $office_id,
        'status'    => $status,
        'doa'       => $doa
    ]);

    if($saved){
        
        [$status, $message] = ['success', 'Department Head added successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, Department Head could not be added'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }


}






?>