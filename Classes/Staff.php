<?php

/**
 * One framework
 * Author: Lamidi Ismaila
 * Email: dgoldenone@gmail.com
 */

namespace Classes;


class Staff{
    
    public $message;
    
    public function __construct(){
        $this->message = "This is the staff class";
    }

    public static function getall(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
        //CURLOPT_URL => 'http://localhost/epms/api_staff',
        CURLOPT_URL => 'http://localhost/epms/staff',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Access-Control-Request-Headers: Accept: application/json',
            'Cookie: PHPSESSID=22fp106bv9hqvgkjfuehunph0e'
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $staff = json_decode($response)->data;
        return $staff;
    }


    public static function getstaff($sid){

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost/epms/api_staff/'.$sid,
        //CURLOPT_URL => 'http://localhost/nomroll/staff/'.$sid,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Cookie: PHPSESSID=22fp106bv9hqvgkjfuehunph0e'
        ),
        ));
    
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, true);
    
        $staff = $data['data']; 
        return $staff;
    }


    public static function getranks(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost/nomroll/ranks',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Cookie: PHPSESSID=9jf3me4n6sptt0l7j498qs0ek5'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;


    }

}