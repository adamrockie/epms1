<?php
require "config.php";
require_once 'twig.php';

use Classes\Config;
use Classes\Permissions;
use Classes\Redirect;
use Database\Models\Users as UserModel;
use Classes\User;
use Classes\Session;
use Classes\Token;
use Database\Models\Discipline;
use Database\Models\Documents;
use Database\Models\DocumentTypes;
use Database\Models\Education;
use Database\Models\Emergency;
use Database\Models\Employees;
use Database\Models\History;
use Database\Models\LeaveHistory;
use Database\Models\LeaveTypes;
use Database\Models\NOK;
use Database\Models\Offices;
use Database\Models\Ranks;
use Database\Models\Requests;
use Database\Models\States;
use Database\Models\Training;

$user = new User();

if($user->isLoggedIn()){

    $sessionName= Config::get('session/session_name');
    $id         = Session::get($sessionName);
    $userc      = UserModel::where('id', '=', $id)->first();
    $role       = Permissions::get_role($id);

    $employee = Employees::where('ippis', '=', $sid)->with('rank')->with('state')->first()->toArray();

    /**Emergency*/
    $emergency = Emergency::where('ippis', '=', $sid)->get()->toArray();
    $emergency_modal = Emergency::where('ippis', '=', $sid)->get();
    $emergency_modal = $emergency_modal->count() > 0 ? $emergency_modal = 'update_emergency_contact_modal' : $emergency_modal = 'emergency_contact_modal';
    /**Next of Kin*/
    $nok = NOK::where('ippis', '=', $sid)->first();
    $nok_check = NOK::where('ippis', '=', $sid)->get();
    $nok_modal = $nok_check->count() > 0 ? $nok_modal = 'update_family_info_modal' : $nok_modal = 'family_info_modal';
    /**Education*/
    $education = Education::where('ippis', '=', $sid)->get()->toArray();
    /**Training*/
    $training = Training::where('ippis', '=', $sid)->get()->toArray();
    /**Documents */
    $documents = Documents::where('ippis', '=', $sid)->with('owner')->with('type')->get()->toArray();
     /**Leave */
     $employee_level = strtolower($employee['gl']); 
     $leave_types = LeaveTypes::where('gl', '=', 'all') 
     ->orWhere('gl', '=', $employee_level)
     ->get()->toArray();
 
     $leaves = LeaveHistory::where('ippis', '=', $sid)->with('leavetype')->get()->toArray(); 
 
     /** Staff History */
     $history = History::where('ippis', '=', $sid)->with('staff')->with('author')->get()->toArray(); 
 
     /** Discipline */
     $discipline = Discipline::where('staff_id', '=', $sid)->with('staff')->get()->toArray(); 
 
     /** Discipline */
     $requests = Requests::where('staff_id', '=', $sid)->with('staff')->get()->toArray(); 

    $doctypes = DocumentTypes::get()->toArray();

    $sessionName= Config::get('session/session_name');
    $id         = Session::get($sessionName);
    $userc      = UserModel::where('id', '=', $id)->first();

    $offices = Offices::all();
    $token = Token::generate();

    $employees  = Employees::with('rank')->get()->toArray();
    $ranks      = Ranks::all(); 
    $states     = States::all(); 
    $current_user = Employees::where('ippis', '=', $userc['ippis'])->first();
   
    echo $twig->render('backend/profile/profile.html.twig', [
        'title'     => 'Profile',
        'userc'     => $userc,
        'employees' => $employees,
        'ranks'     => $ranks,
        'states'    => $states,
        'employee'  => $employee,
        'emergency' => $emergency,
        'educations'=> $education,
        'trainings' => $training,
        'documents' => $documents,
        'doctypes'  => $doctypes,
        'nok'       => $nok,
        'emergency_modal' => $emergency_modal,
        'nok_modal' => $nok_modal,
        'sid'       => $sid,
        'leave_types' => $leave_types,
        'leaves'      => $leaves,
        'history'     => $history,
        'disciplines' => $discipline,
        'requests'    => $requests,
        'token'     => $token,
        'role'      => $role,
        'current_user' => $current_user,        
        ]);


}else{
    Redirect::to('home');
}

?>