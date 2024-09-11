<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Database\Models\Units;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

    $office_id = Input::get('office_id');
    
    $units = Units::where('office_id', $office_id)->get()->toArray();

    //var_dump($units);
    //exit;

    if($units){
        echo '<option value="">Select a Unit</option>';
        foreach ($units as $unit) {
            echo '<option value='.$unit['unit_id'].'>'.$unit['name'].'<option>'; 
          }
    }else{
        echo '<option value="">Units not available</option>'; 
    }

}


?>