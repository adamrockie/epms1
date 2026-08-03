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

if (empty(trim($_POST['remark']))) {
    echo json_encode([
        "status" => "error",
        "msg" => "Remark cannot be empty"
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

// Remarks can be added regardless of status - append with a timestamp
// rather than overwrite, so the history isn't lost.
$entry = "[" . date('Y-m-d H:i') . "] " . trim($_POST['remark']);
$req->remarks = $req->remarks ? $req->remarks . "\n" . $entry : $entry;

if ($req->save()) {
    echo json_encode([
        "status"  => "success",
        "msg"     => "Remark Added",
        "remarks" => $req->remarks
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "msg" => "Failed to add remark"
    ]);
}
?>