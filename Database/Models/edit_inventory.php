<?php
require "config.php";

use Database\Models\Inventory;

header('Content-Type: application/json');

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode(["status"=>"error","msg"=>"Missing ID"]);
    exit;
}

$item = Inventory::find($id);

if (!$item) {
    echo json_encode(["status"=>"error","msg"=>"Record not found"]);
    exit;
}

echo json_encode($item);
?>
