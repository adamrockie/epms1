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


    $ippis      = Sanitize::sanitize(Input::get('ippis'));
    $office_id  = Sanitize::sanitize(Input::get('office_id'));
    $unit_id    = Sanitize::sanitize(Input::get('unit_id'));
    $pid        = Sanitize::sanitize(Input::get('pid'));
    $posting_id = rand(100, 99999).date('hms');

    $saved = Posting::create([
        'posting_id'  => $posting_id,
        'ippis'       => $ippis,
        'office_id'   => $office_id,
        'unit_id'     => $unit_id,
        'start_date'  => date('Y-m-d'),
        'status'      => 'Pending',
    ]);

    if($pid != ''){
        $served = Posting::where([
            ['posting_id', '=', $pid],
            ['status', '=', 'Approved']
            ])->get()->toArray();
            if(count($served) > 0){
                $posting = Posting::where('posting_id', '=', $pid)->update([
                    'status' => 'Served',
                    'end_date' => date('Y-m-d')
                ]);
            }else{
                $posting = Posting::where('posting_id', '=', $pid)->update([
                    'status' => 'Rejected',
                    'end_date' => date('Y-m-d')
                ]);  
            }
    }

    if($saved){
        
        [$status, $message] = ['success', 'Staff posted successfully, awaiting approval'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, staff could not be posted'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }


}






?>