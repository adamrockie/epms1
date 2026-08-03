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

$req = RequestItems::where('id', '=', $_POST['id'])->first();

if (!$req) {
    echo json_encode([
        "status" => "error",
        "msg" => "Request not found"
    ]);
    exit;
}

// Only allow deleting while still pending - once reviewed, keep it for the record
if ($req->status !== 'pending') {
    echo json_encode([
        "status" => "error",
        "msg" => "This request has already been reviewed and can no longer be deleted"
    ]);
    exit;
}

if ($req->delete()) {
    echo json_encode([
        "status" => "success",
        "msg" => "Request Deleted Successfully"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "msg" => "Failed to delete request"
    ]);
}
?>