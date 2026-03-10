<?php
require "config.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");

use Database\Models\ItemRequests;
use Database\Models\Inventory;

$data = json_decode(file_get_contents("php://input"), true);

if(!$data || empty($data['items'])){
    echo json_encode([
        "success" => 0,
        "message" => "No items received"
    ]);
    exit;
}

try {

    foreach($data['items'] as $item){

        // Skip if no item_id or qty sent
        $qty = $item['qty'] ?? null;
        if(empty($item['item_id']) || empty($qty)){
            continue;
        }

        $inventoryItem = Inventory::where('id', $item['item_id'])->first();

        $itemName = $inventoryItem ? $inventoryItem->inventory : '';

        // Save exactly what is sent
        ItemRequests::create([
            'rid'                  => $item['rid'] ?? uniqid('req_'),
            'ippis'                => $data['ippis'] ?? '',
            'item_id'              => $item['item_id'],
            'item_name'            => $itemName,
            'item_description'     => $item['item_description'] ?? '',
            'qty'                  => $qty,
            'head'                 => $item['head'] ?? '',
            'head_approval_status' => $item['head_approval_status'] ?? 'pending',
            'dir_approval_date'    => $item['dir_approval_date'] ?? null,
            'agf'                  => $item['agf'] ?? '',
            'agf_approval_status'  => $item['agf_approval_status'] ?? 'pending',
            'agf_approval_date'    => $item['agf_approval_date'] ?? null,
            'status'               => $item['status'] ?? 'pending',
            'request_date'         => $item['request_date'] ?? date('Y-m-d H:i:s'),
            'comment'              => $item['comment'] ?? '',
            'created_at'           => $item['created_at'] ?? date('Y-m-d H:i:s'),
            'updated_at'           => $item['updated_at'] ?? date('Y-m-d H:i:s'),
            'deleted_at'           => $item['deleted_at'] ?? null,
        ]);
    }

    echo json_encode([
        "success" => 1,
        "message" => "Request submitted successfully"
    ]);

} catch(Exception $e){
    echo json_encode([
        "success" => 0,
        "message" => $e->getMessage()
    ]);
}