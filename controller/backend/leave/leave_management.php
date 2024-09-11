<?php
require "config.php";
require_once 'twig.php';

use Classes\Redirect;
use Classes\User;
use Classes\Session;
use Classes\Token;
use Database\Models\LeaveHistory;
use Database\Models\LeaveTypes;

$user = new User();

if($user->isLoggedIn()){


    $leave_types = LeaveTypes::all();
    $leave_requests = LeaveHistory::where('request_status', '=', 'Pending')->with('employee')->with('office')->get()->toArray();

    $token = Token::generate();
       
   
    echo $twig->render('backend/leave/leave.html.twig', [
        'title'     => 'Leave Management',
        /*
        'userc'     => $userc,
        'employee'  => $employee,
        'emergency' => $emergency,
        'educations'=> $education,
        'documents' => $documents,
        'doctypes'  => $doctypes,
        'nok'       => $nok,
        'emergency_modal' => $emergency_modal,
        'nok_modal' => $nok_modal,*/
        'leave_types' => $leave_types,
        'leave_requests' => $leave_requests,
        'token'       => $token   
             
        ]);


}else{
    Redirect::to('home');
}

?>