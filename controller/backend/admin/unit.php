<?php
require "config.php";
require_once 'twig.php';

use Classes\Config;
use Classes\Redirect;
use Database\Models\Users as UserModel;
use Classes\User;
use Classes\Session;
use Classes\Token;
use Database\Models\Offices;
use Database\Models\Units;

$user = new User();

if($user->isLoggedIn()){
    
    $sessionName= Config::get('session/session_name');
    $id         = Session::get($sessionName);
    $userc      = UserModel::where('id', '=', $id)->first();
    $token      = Token::generate();

    
    $office = Offices::where('office_id', '=', $oid)->get()->toArray();

    $units = Units::where('office_id', '=', $oid)->with('office')->get();

    //var_dump($units);
    //exit;
    echo $twig->render('backend/admin/units.html.twig', [
        'title'     => $office[0]['name'].' Units',
        'userc'     => $userc,
        'token'     => $token,
        'office'    => $office,
        'units'     => $units,
        'oid'       => $oid        
        ]);


}else{
    Redirect::to('home');
}

?>