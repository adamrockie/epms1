<?php

/**
 * One framework
 * Author: Lamidi Ismaila
 * Email: dgoldenone@gmail.com
 */

namespace Classes;

use Database\Models\History;

class StaffHistory{
    public static function log($ippis, $type, $description='', $author){
        $saved = History::create([
            'ipps'         => $ippis,
            'type'         => $type,
            'description'  => $description,
            'author'       => $author
        ]);

        if($saved){
        
            [$status, $message] = ['success', 'Staff history saved successfully'];
            return json_encode(['status'=>$status, 'msg'=>$message]);
    
        }else{
    
            [$status, $message] = ['error', 'An error occurred, Staff history could not be added'];
            return json_encode(['status'=>$status, 'msg'=>$message]);
        }
        
    }

}