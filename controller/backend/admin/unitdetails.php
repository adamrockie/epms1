<?php
require "config.php";
require_once 'twig.php';

use Classes\Redirect;
use Classes\User;
use Classes\Token;
use Database\Models\Employees;
use Database\Models\Posting;
use Database\Models\Ranks;
use Database\Models\Units;

require_once 'controller/backend/core.php';
$user = new User();

if($user->isLoggedIn()){
    
    $token      = Token::generate();
    $employees  = Employees::all();
    $units      = Units::where('unit_id', '=', $oid)->with('office')->get()->toArray();
    $office_id = $units[0]['office']['office_id'];

    $members = Posting::where([
        ['unit_id', '=', $oid],
        ['status', '=', 'Approved']
        ])->orWhere([
        ['unit_id', '=', $oid],
        ['status', '=', 'Pending'] 
        ])->with('staff')->with('staff_rank')->get()->toArray();
 
        $mem = array();
        foreach ($members as $key => $member) {

            $rank  = Ranks::find($member['staff']['rank'])->toArray();

            $mem[$key] = array(
                "names"     => $member['staff']['surname'].' '.$member['staff']['lastname'].' '.$member['staff']['middlename'], 
                "title"     => $member['staff']['title'], 
                "rank"      => $rank['rank'],
                "gl"        => $member['staff']['gl'],
                "start_date"=> $member['start_date'],
                "ippis"     => $member['ippis'],
                "office_id" => $member['office_id'],
                "unit_id"   => $member['unit_id'],
                "status"    => $member['status']
            );   
        }

        echo $twig->render('backend/admin/unitdetails.html.twig', [
            'title'     => $units[0]['name'].' Unit',
            'location'  => $units[0]['location'],
            'userc'     => $userc,
            'token'     => $token,
            'units'     => $units,
            'oid'       => $oid,
            'office_id' => $office_id,
            'members'   => $mem,
            'employees' => $employees,
            'role'      => $role
            ]);
  //  }


}else{
    Redirect::to('home');
}

?>