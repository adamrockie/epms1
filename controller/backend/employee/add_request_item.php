<?php
require "config.php";

use Classes\Token;
use Classes\Session;
use Classes\Config;
use Database\Models\Users as UserModel;
use Database\Models\Employees;
use Database\Models\RequestItems;

// validate CSRF token
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

// Identify the requester from the session - never trust a submitted user id
$sessionName  = Config::get('session/session_name');
$id           = Session::get($sessionName);
$userc        = UserModel::where('id', '=', $id)->first();
$current_user = Employees::where('ippis', '=', $userc['ippis'])->first();

$req = new RequestItems();
$req->subject     = $_POST['subject'];
$req->description = $_POST['description'];
$req->status      = 'pending'; 

if ($req->save()) {
    echo json_encode([
        "status" => "success",
        "msg" => "Request Submitted Successfully"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "msg" => "Failed to submit request"
    ]);
}
?>