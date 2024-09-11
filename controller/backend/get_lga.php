<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Database\Models\Lga;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){
    
    $lgas = Lga::where('state_id', $id)->get()->toArray();

    if($lgas){
        echo '<option value="">Select Local Government</option>';
        foreach ($lgas as $lga) {
            echo '<option value="'.$lga['lga_name'].'">'.$lga['lga_name'].'<option>'; 
          }
    }else{
        echo '<option value="">Local Government not available</option>'; 
    }

}


?>