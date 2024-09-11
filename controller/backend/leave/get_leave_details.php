<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Database\Models\Comments;
use Database\Models\LeaveHistory;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){


    $leave = LeaveHistory::where('id', '=', $id)->with('leavetype')->with('employee')->get()->toArray();


    $comment = Comments::where('source', '=', 'leave')->where('source_id', '=', $id)->with('author')->get()->toArray(); 

    if(empty($comment)){
        $comment = array();
        $comment[0] = null;
    }

 
    if($leave){

        [$status, $message, ] = ['success', 'Leave details retrieved successfully'];
        echo json_encode([
            'leave' => $leave[0],
            'comment' => $comment[0]
        ]);

    }else{
        [$status, $message, ] = ['error', 'Leave details not found'];
        echo json_encode([
            'status'      =>$status, 
            'msg'         =>$message
        ]);
    }

}

?>