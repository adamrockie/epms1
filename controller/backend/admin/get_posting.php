<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Database\Models\Employees;
use Database\Models\Offices;
use Database\Models\Posting;
use Database\Models\Ranks;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

    $posting = Posting::where([
        ['ippis', '=', $ippis],
        ['status', '=', 'Approved']
        ])->orWhere([
        ['ippis', '=', $ippis],
        ['status', '=', 'Pending'] 
        ])->get()->toArray();

    if(count($posting) > 0){

        $pid = $posting[0]['posting_id'];
        $dp  = $posting[0]['start_date'];
        $ps  = $posting[0]['status'];

        $department = Offices::where('office_id', '=', $posting[0]['office_id'])->get('name')->toArray();
        $current_posting = $department[0]['name'];

        $employee = Employees::where('ippis', '=', $ippis)->get();
        $rk = $employee[0]['rank'];
        $gl   = $employee[0]['gl'];

        $rank = Ranks::where('id', '=', $rk)->first();
        $rank = $rank['rank'];

        [$status, $message, ] = ['success', 'Posting record retrieved successfully'];
        echo json_encode([
            'status'          => $status, 
            'msg'             => $message,
            'current_posting' => $current_posting,
            'rank'            => $rank,
            'gl'              => $gl,
            'dp'              => $dp,
            'pid'             => $pid,
            'pstatus'         => $ps
        ]);

    }else{

        [$status, $message, ] = ['failed', 'Staff has no previous posting record'];
        echo json_encode([
            'status'          => $status, 
            'msg'             => $message,
            'current_posting' => '',
            'rank'            => '',
            'gl'              => '',
            'dp'              => '',
            'pid'             => '',
            'pstatus'         => ''
        ]);

    }

}


?>