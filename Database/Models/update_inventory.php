<?php
require "config.php";

use Classes\Token;
use Database\Models\Inventory;

header('Content-Type: application/json');

if (!Token::check($_POST['token'])) {
    echo json_encode(["status"=>"error","msg"=>"Invalid Token"]);
    exit;
}

$id = $_POST["id"] ?? null;
$item = Inventory::find($id);

if (!$item) {
    echo json_encode(["status"=>"error","msg"=>"Item not found"]);
    exit;
}

// handle file upload
$filename = $item->upload;
if (!empty($_FILES['upload']['name'])) {
    $filename = time() . "_" . preg_replace("/[^A-Za-z0-9._-]/","_",$_FILES["upload"]["name"]);
    move_uploaded_file($_FILES["upload"]["tmp_name"], "uploads/inventory/" . $filename);
}

$item->inventory = $_POST['inventory'];

$item->quantity  = $_POST['quantity'];
$item->status    = $_POST['status'];
$item->warranty  = $_POST['warranty'];
$item->date      = $_POST['date'];
$item->upload    = $filename;
$item->save();

echo json_encode(["status"=>"success","msg"=>"Inventory Updated Successfully"]);
?>