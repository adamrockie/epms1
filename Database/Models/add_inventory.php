<?php
require "config.php";

use Classes\Token;
use Database\Models\Inventory;

// Return JSON only
header('Content-Type: application/json');

// Validate CSRF token
if (!Token::check($_POST['token'])) {
    echo json_encode([
        "status" => "error",
        "msg" => "Invalid CSRF token"
    ]);
    exit;
}

//  Validate required fields
$required = ["inventory", "quantity", "status", "warranty", "quantity", "date"];
foreach ($required as $field) {
    if (empty($_POST[$field])) {
        echo json_encode([
            "status" => "error",
            "msg" => "Missing field: $field"
        ]);
        exit;
    }
}

// ✅ Handle File Upload
$filename = "";
if (!empty($_FILES['upload']['name'])) {
    $filename = time() . "_" . preg_replace("/[^A-Za-z0-9._-]/", "_", $_FILES['upload']['name']);
    $destination = "uploads/inventory/" . $filename;

    if (!move_uploaded_file($_FILES['upload']['tmp_name'], $destination)) {
        echo json_encode([
            "status" => "error",
            "msg" => "File upload failed"
        ]);
        exit;
    }
}

// ✅ Save to DB using Eloquent
try {
    Inventory::create([
        "inventory" => $_POST["inventory"],
        'category'    => $_POST['category'],  
        "quantity"  => $_POST["quantity"],
        "amount"  => $_POST["amount"],
        "warranty"  => $_POST["warranty"],
        "life_span"  => $_POST["life_span"],
        "status"    => $_POST["status"],
        "date"      => $_POST["date"],
        "upload"    => $filename
    ]);

    echo json_encode([
        "status" => "success",
        "msg" => "Inventory added successfully"
    ]);

} catch (Exception $e) {

    echo json_encode([
        "status" => "error",
        "msg" => "Database error: " . $e->getMessage()
    ]);
}

?>