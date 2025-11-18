<?php
require "config.php";

use Classes\Token;
use Classes\Session;
use Classes\Redirect;
use Database\Models\Inventory;

// validate CSRF token
if (!Token::check($_POST['token'])) {
    echo json_encode([
        "status" => "error",
        "msg" => "Invalid token"
    ]);
    exit;
}

// Handle file upload
$upload = "";
if(!empty($_FILES['upload']['name'])){
    $filename = time() . "_" . $_FILES['upload']['name'];
    $path = "uploads/inventory/" . $filename;
    move_uploaded_file($_FILES['upload']['tmp_name'], $path);
    $upload = $filename;
}

// save to DB
$inv = new Inventory();
$inv->inventory = $_POST['inventory'];
$inv->quantity  = $_POST['quantity'];
$inv->status    = $_POST['status'];
$inv->warranty  = $_POST['warranty'];
$inv->date      = $_POST['date'];
$inv->upload    = $upload;

if ($inv->save()) {
    echo json_encode([
        "status" => "success",
        "msg" => "Inventory Added Successfully"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "msg" => "Failed to save inventory"
    ]);
}
?>
