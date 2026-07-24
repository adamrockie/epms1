<?php
require "config.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");

use Database\Models\ItemRequests;

$data = json_decode(file_get_contents("php://input"), true);

if(!$data || empty($data['id']) || empty($data['action'])){
    echo json_encode([
        "success" => 0,
        "message" => "Invalid request"
    ]);
    exit;
}

// Reject actions must include a reason
if($data['action'] === 'reject' && empty(trim($data['reason'] ?? ''))){
    echo json_encode([
        "success" => 0,
        "message" => "A reason is required when not recommending"
    ]);
    exit;
}

try {

    $request = ItemRequests::where('id', intval($data['id']))->first();

    if(!$request){
        echo json_encode([
            "success" => 0,
            "message" => "Request not found"
        ]);
        exit;
    }

    $updateData = [
        'head_approval_status' => $data['action'],
        'dir_approval_date'    => date('Y-m-d H:i:s'),
        'updated_at'           => date('Y-m-d H:i:s'),
    ];

    if($data['action'] === 'reject'){
        $updateData['head_rejection_reason'] = trim($data['reason']);
        // if head rejects, the overall status should reflect that too
        $updateData['status'] = 'reject';
    } else {
        $updateData['head_rejection_reason'] = null;
    }

    $request->update($updateData);

    echo json_encode([
        "success" => 1,
        "message" => "Director response saved"
    ]);

} catch(Exception $e){

    echo json_encode([
        "success" => 0,
        "message" => $e->getMessage()
    ]);
}