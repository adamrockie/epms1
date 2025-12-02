<?php

/**
 * One framework
 * Author: Lamidi Ismaila
 * Email: dgoldenone@gmail.com
 */

namespace Classes;


class ApiCalls{
    
    public $message;
    
    public function __construct(){
        $this->message = "This is the api class";
    }

    public static function getallrequests(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
        //CURLOPT_URL => 'http://localhost/epms/api_staff',
        CURLOPT_URL => 'http://localhost/epms/api_pending_items_requests',
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


    public static function getrequest($sid){

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost/epms/api_requests/'.$sid,
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

}