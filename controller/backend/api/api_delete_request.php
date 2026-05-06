<?php
require "config.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");

use Database\Models\ItemRequests;

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || empty($data['id'])) {
    echo json_encode([
        "success" => 0,
        "message" => "Invalid request"
    ]);
    exit;
}

try {

    $request = ItemRequests::where('id', intval($data['id']))->first();

    if (!$request) {
        echo json_encode([
            "success" => 0,
            "message" => "Request not found"
        ]);
        exit;
    }


    if ($request->head_approval_status == 'approve') {
        echo json_encode([
            "success" => 0,
            "message" => "Cannot delete approved request"
        ]);
        exit;
    }

    /** DELETE */
    $request->delete();

    echo json_encode([
        "success" => 1,
        "message" => "Request deleted successfully"
    ]);

} catch (Exception $e) {

    echo json_encode([
        "success" => 0,
        "message" => $e->getMessage()
    ]);
}