<?php
require "config.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

use Database\Models\ItemRequests;

$ippis = $_GET['ippis'] ?? null;

if(!$ippis){
    echo json_encode([
        "success" => 0,
        "message" => "IPPIS is required"
    ]);
    exit;
}

try {

    $requests = ItemRequests::where('ippis', $ippis)
        ->orWhere('head', $ippis)
        ->orWhere('agf', $ippis)
        ->orderBy('request_date','desc')
        ->get()
        ->toArray();

    if($requests){
        echo json_encode([
            "success" => 1,
            "data" => $requests
        ]);
    }else{
        echo json_encode([
            "success" => 0,
            "message" => "No requests found"
        ]);
    }

} catch(Exception $e){
    echo json_encode([
        "success" => 0,
        "message" => $e->getMessage()
    ]);
}