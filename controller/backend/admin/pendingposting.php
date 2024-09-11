<?php
require "config.php";
require_once 'twig.php';

use Carbon\Traits\Timestamp;
use Classes\Config;
use Classes\Redirect;
use Database\Models\Users as UserModel;
use Classes\User;
use Classes\Token;
use Classes\Session;
use Database\Models\Employees;
use Database\Models\Offices;
use Database\Models\Posting;
use Database\Models\Ranks;

require_once 'controller/backend/core.php';
$user = new User();

if($user->isLoggedIn()){

    $token = Token::generate();

    $staff = Employees::with('rank')->with('current_office')->get()->toArray();

    $ranks      = Ranks::all();
    $offices    = Offices::all()->sortBy('name');
    $pending    = Posting::where('status', '=', 'Pending')->with('staff_rank')->with('staff')->with('unit')->with('office')->get()->toArray();
    //var_dump($pending);
    //exit;
    //$num_pending = count($pending);

    /*
    $members = Posting::where('status', '=', 'Approved')->with('staff')->with('staff_rank')->get()->toArray();
        ['status', '=', 'Approved']
        )->orWhere([
        ['unit_id', '=', $oid],
        ['status', '=', 'Pending'] 
        ])->with('staff')->with('staff_rank')->get()->toArray();

        $mem = array();
        foreach ($members as $key => $member) {

            $rank  = Ranks::find($member['staff'][0]['rank'])->toArray();

            $mem[$key] = array(
                "names"     => $member['staff'][0]['surname'].' '.$member['staff'][0]['lastname'].' '.$member['staff'][0]['middlename'], 
                "title"     => $member['staff'][0]['title'], 
                "rank"      => $rank['rank'],
                "gl"        => $member['staff'][0]['gl'],
                "start_date"=> $member['start_date'],
                "ippis"     => $member['ippis'],
                "office_id" => $member['office_id'],
                "unit_id"   => $member['unit_id'],
                "status"    => $member['status']
            );   
        }
    */
 
    echo $twig->render('backend/admin/pendingpost.html.twig', [
        'title'     => 'Current Postings Pending Approval',
        'userc'     => $userc,
        'employees' => $staff,
        'ranks'     => $ranks,
        'offices'   => $offices,
        'token'     => $token,
        'pendings'  => $pending,
        'role'      => $role     
        ]);
}else{
    Redirect::to('home');
}

?>