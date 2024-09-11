<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Database\Models\Emergency;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if($user->isLoggedIn()){

    $entries = array();

    $entries[1] = [
        'names'        => Sanitize::sanitize(Input::get('names')),
        'relationship' => Sanitize::sanitize(Input::get('relationship')),
        'phone_1'      => Sanitize::sanitize(Input::get('phone_1')),
        'phone_2'      => Sanitize::sanitize(Input::get('phone_2')),
        'type'         => Sanitize::sanitize(Input::get('type_1')),
        'ippis'     => Sanitize::sanitize(Input::get('sid')),
        'id'           => Sanitize::sanitize(Input::get('id'))
    ];

    $entries[2] = [
        'names'          => Sanitize::sanitize(Input::get('names_2')),
        'relationship'   => Sanitize::sanitize(Input::get('relationship_2')),
        'phone_1'        => Sanitize::sanitize(Input::get('phone_3')),
        'phone_2'        => Sanitize::sanitize(Input::get('phone_4')),
        'type'           => Sanitize::sanitize(Input::get('type_2')),
        'ippis'       => Sanitize::sanitize(Input::get('sid_2')),
        'id'             => Sanitize::sanitize(Input::get('id2'))
    ]; 
    
    foreach ($entries as $key => $entry) {
        
        $saved = Emergency::where('id', '=', $entries[$key]['id'])->update([
            'names'        => $entries[$key]['names'],
            'relationship' => $entries[$key]['relationship'],
            'phone_1'      => $entries[$key]['phone_1'],
            'phone_2'      => $entries[$key]['phone_2'],
            'type'         => $entries[$key]['type']
        ]);
          
    }

    if($saved){
        
        [$status, $message] = ['success', 'Emergency details saved successfully'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);

    }else{

        [$status, $message] = ['error', 'An error occurred, emergency details could not be added'];
        echo json_encode(['status'=>$status, 'msg'=>$message]);
    }
}


?>