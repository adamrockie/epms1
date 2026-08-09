<?php
require "config.php";

use Database\Models\RequestItems;

header('Content-Type: application/json');

$requestId = $_GET['id'] ?? null;

$req = RequestItems::where('id', '=', $requestId)->first();

if (!$req) {
    echo json_encode([
        "status" => "error",
        "msg" => "Request not found"
    ]);
    exit;
}

echo json_encode([
    "status"      => "success",
    "id"          => $req->id,
    "subject"     => $req->subject,
    "description" => $req->description,
    "status_val"  => $req->status,
    "note"        => $req->note,
    "remarks"     => $req->remarks,
]);
?>