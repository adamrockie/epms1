<?php
require "config.php";

use Classes\Token;
use Database\Models\RequestItems;

if (!Token::check($_POST['token'])) {
    echo json_encode([
        "status" => "error",
        "msg" => "Invalid token"
    ]);
    exit;
}

if (empty(trim($_POST['subject'])) || empty(trim($_POST['description']))) {
    echo json_encode([
        "status" => "error",
        "msg" => "Subject and description are required"
    ]);
    exit;
}

$req = RequestItems::where('id', '=', $_POST['id'])->first();

if (!$req) {
    echo json_encode([
        "status" => "error",
        "msg" => "Request not found"
    ]);
    exit;
}

// Only allow editing while still pending - once reviewed, it's locked
if ($req->status !== 'pending') {
    echo json_encode([
        "status" => "error",
        "msg" => "This request has already been reviewed and can no longer be edited"
    ]);
    exit;
}

$req->subject     = $_POST['subject'];
$req->description = $_POST['description'];

if ($req->save()) {
    echo json_encode([
        "status" => "success",
        "msg" => "Request Updated Successfully"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "msg" => "Failed to update request"
    ]);
}
?>