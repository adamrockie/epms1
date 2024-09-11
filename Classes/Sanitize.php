<?php
/**
 * One framework
 * Author: Lamidi Ismaila
 * Email: dgoldenone@gmail.com
 */

namespace Classes;

class Sanitize{

    public static function sanitize($string){
        return filter_var($string, FILTER_SANITIZE_STRING);
      return filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS);
      return filter_var($string, FILTER_SANITIZE_STRIPPED);
    }

    public static function escape($string){
        //return htmlentities($string, ENT_QUOTES, 'UTF-8');
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }



}