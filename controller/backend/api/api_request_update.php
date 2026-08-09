<?php
require "config.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

use Database\Models\ItemRequests;

// Get params
$ippis  = $_GET['ippis'] ?? null;
$status = $_GET['status'] ?? null;

// Validate
if (!$ippis) {
    echo json_encode([
        "success" => 0,
        "message" => "IPPIS is required"
    ]);
    exit;
}

if (!$status) {
    echo json_encode([
        "success" => 0,
        "message" => "Status is required (disbursed / not_disbursed)"
    ]);
    exit;
}

try {

    $requests = ItemRequests::where(function ($q) use ($ippis) {
            $q->where('ippis', $ippis)
              ->orWhere('head', $ippis)
              ->orWhere('agf', $ippis);
        })
        ->where('status', $status) 
        ->orderBy('given_date', 'desc')
        ->get()
        ->toArray();

    if ($requests) {
        echo json_encode([
            "success" => 1,
            "data" => $requests
        ]);
    } else {
        echo json_encode([
            "success" => 0,
            "message" => "No {$status} requests found"
        ]);
    }

} catch (Exception $e) {
    echo json_encode([
        "success" => 0,
        "message" => $e->getMessage()
    ]);
}