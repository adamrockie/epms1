<?php

/**
 * One framework
 * Author: Lamidi Ismaila
 * Email: dgoldenone@gmail.com
 */

namespace Classes;


class Message{
    
    public $message;
    
    public function setmessage($msg){
        $this->message = $msg;
    }

    public function getmessage(){
        echo $this->message;
    }

}