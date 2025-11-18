<?php
require "config.php";

use Database\Models\Inventory;

header('Content-Type: application/json');

$id = $_POST["id"] ?? null;

if (!$id) {
    echo json_encode(["status"=>"error","msg"=>"Missing ID"]);
    exit;
}

$item = Inventory::find($id);

if (!$item) {
    echo json_encode(["status"=>"error","msg"=>"Record not found"]);
    exit;
}

// delete file
if (!empty($item->upload) && file_exists("uploads/inventory/" . $item->upload)) {
    unlink("uploads/inventory/" . $item->upload);
}

// delete item
$item->delete();

echo json_encode(["status"=>"success","msg"=>"Inventory Deleted Successfully"]);
?>
