<?php
require "config.php";


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

use Database\Models\Employees;

//require $_SERVER['DOCUMENT_ROOT'].'/login_api/middlewares/Auth.php';
//require __DIR__.'/middlewares/Auth.php';

$allHeaders = getallheaders();

$staff = Employees::where('status', '=', 'active')->get()->toArray();


if($staff) :
    echo json_encode([
        'success' => 1,
        'data' => $staff,
    ]);
else :
    echo json_encode([
        'success' => 0,
        'message' => 'No Result Found!',
    ]);
endif;

?>