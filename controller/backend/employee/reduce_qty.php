<?php
require "config.php";

use Database\Models\Inventory;

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'] ?? null;

header('Content-Type: application/json');

if(!$id){
    echo json_encode(["status"=>"error","msg"=>"Invalid ID"]);
    exit;
}

$item = Inventory::find($id);

if(!$item){
    echo json_encode(["status"=>"error","msg"=>"Item not found"]);
    exit;
}

if($item->quantity <= 0){
    echo json_encode(["status"=>"error","msg"=>"Out of stock"]);
    exit;
}

$item->quantity -= 1;

if($item->save()){
    echo json_encode(["status"=>"success","msg"=>"Item issued successfully"]);
}else{
    echo json_encode(["status"=>"error","msg"=>"Failed to update"]);
}