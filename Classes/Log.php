<?php

/**
 * One framework
 * Author: Lamidi Ismaila
 * Email: dgoldenone@gmail.com
 */

namespace Classes;

use Classes\DB;


class Log{

    private $_db,
            $_data,
            $_sessionName,
            $_cookieName,
            $_isLoggedIn;

    public function __construct($user = null){
        $this->_db = DB::getInstance();
    }
    
    
    public function loggin($fields = array())
    {
        if(!$this->_db->insert('logs', $fields)){
            throw new Exception('There was a problem logging the record.');
        }  
    }
    



    public function findAllLogs($table = null){
        if($table){
            $data = $this->_db->getAll('logs', $table);
            
            if($data->count()){
                $this->_data = $data->all();
                return true;
            }

        }
        return false;
    }


public function data(){
    return $this->_data;
}

}
?>