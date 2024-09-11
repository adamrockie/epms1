<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Classes\Token;
use Database\Models\Comments;
use Database\Models\Employees;
use Database\Models\LeaveHistory;
use Database\Models\LeaveTypes;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn() && Token::check(Input::get('token'))){

    $request_type = Sanitize::sanitize(Input::get('request_type'));

    if($request_type == 'leave'){

        $get_ldetails = LeaveHistory::where('id', '=', Input::get('aleave_id'))->first();
        $staff_id = $get_ldetails->staff_id;
        $requested_days = $get_ldetails->days;

        $employee = Employees::where('staff_id', '=', $staff_id)->with('office')->with('designation')->first()->toArray();
        $employee_level = strtolower($employee['level']);

        //Total Available Leave for a user
        $leave_types = LeaveTypes::where('level', '=', 'all')->orWhere('level', '=', $employee_level)->get()->toArray();

        $total_available_leave = 0;
        foreach ($leave_types as $leave_type) {
            $leave_type_days = $leave_type['days'];
            $total_available_leave += $leave_type_days;
        }
        
        //Total Leave Taken by a user in a particular year
        $yy = date('Y');
        $used_leave = LeaveHistory::where('staff_id', '=', $staff_id)->where('request_status', '=', 'Approved')->where('start_date', '<=', $yy.'-12-31')->where('start_date', '>', ($yy-1).'-12-31')->get()->toArray();

        $total_used = 0;
        if(count($used_leave) > 0){
            foreach ($used_leave as $used) {
                $used_days = $used['days'];
                $total_used += $used_days;
            }
        }

        //total Leave remaining for 
        $total_remaining = $total_available_leave - $total_used;


        if($total_remaining < $requested_days){

            [$status, $message] = ['error', 'Sorry the employee has only '.$total_remaining. ' day(s) of leave remaining'];
            echo json_encode(['status'=>$status, 'msg'=>$message]);

        }else{

            LeaveHistory::where('id', '=', Input::get('aleave_id'))->update(array(
                'request_status' => 'Approved'
            ));

            Comments::create([
                'source'    => 'leave',
                'source_id' => Input::get('aleave_id'),
                'author'    => $user->data()->staff_id,
                'status'    => 'unread',
                'comment'   => Sanitize::sanitize(Input::get('comment'))
            ]);

            [$status, $message] = ['success', 'Leave Approved Successfully'];
            echo json_encode(['status'=>$status, 'msg'=>$message]);
        }

    }
    elseif($request_type == 'reject_leave'){

        LeaveHistory::where('id', '=', Input::get('rleave_id'))->update(array(
            'request_status' => 'Rejected'
        ));

        [$status, $message] = ['success', 'Leave Rejected Successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }

}


?>