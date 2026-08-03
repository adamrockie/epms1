<?php
require "config.php";

use Database\Models\RequestItems;

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

$id     = $input['id'] ?? null;
$action = $input['action'] ?? null;  
$reason = $input['reason'] ?? '';

if (!$id || !in_array($action, ['approve', 'reject'])) {
    echo json_encode([
        "status" => "error",
        "msg" => "Invalid request"
    ]);
    exit;
}

$req = RequestItems::where('id', '=', $id)->first();

if (!$req) {
    echo json_encode([
        "status" => "error",
        "msg" => "Request not found"
    ]);
    exit;
}

if ($req->status !== 'pending') {
    echo json_encode([
        "status" => "error",
        "msg" => "This request has already been reviewed"
    ]);
    exit;
}

$req->status = $action;
$req->note   = $reason;

if ($req->save()) {
    echo json_encode([
        "status" => "success",
        "msg" => "Request " . ($action === 'approve' ? 'approved' : 'rejected') . " successfully"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "msg" => "Failed to update request"
    ]);
}
?>