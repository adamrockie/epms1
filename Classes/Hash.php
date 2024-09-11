<?php

/**
 * One framework
 * Author: Lamidi Ismaila
 * Email: dgoldenone@gmail.com
 */

namespace Classes;



class Hash{
    public static function make($string, $salt = ''){
        
        return password_hash($string, PASSWORD_DEFAULT);
    }

    // I no longer use salt has Php password_hash function has improve their hashing for  PHP => 5.5 
    public static function salt(){
        //return mcrypt_create_iv($length);
        return rand(10, 1000);
    }

    public static function unique(){
        return self::make(uniqid());
    }
}