<?php
require "config.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

use Database\Models\ItemRequests;

// Get params
$ippis = $_GET['ippis'] ?? null;

// Validate
if (!$ippis) {
    echo json_encode([
        "success" => 0,
        "message" => "IPPIS is required"
    ]);
    exit;
}

try {

    // HEAD pending approvals
    $head_pending = ItemRequests::with('staff')
    ->where('head', $ippis)
        ->where(function($q){
            $q->where('head_approval_status', 'pending')
              ->orWhereNull('head_approval_status');
        })
        ->orderBy('request_date', 'desc')
        ->get()
        ->toArray();

    // AGF pending approvals (only after head approved)
    $agf_pending = ItemRequests::with('staff')->where('agf', $ippis)
        ->where('head_approval_status', 'approve')
        ->where(function($q){
            $q->where('agf_approval_status', 'pending')
              ->orWhereNull('agf_approval_status');
        })
        ->orderBy('request_date', 'desc')
        ->get()
        ->toArray();

    echo json_encode([
        "success" => 1,
        "data" => [
            "head_pending" => $head_pending,
            "agf_pending"  => $agf_pending
        ]
    ]);

} catch (Exception $e) {
    echo json_encode([
        "success" => 0,
        "message" => $e->getMessage()
    ]);
}