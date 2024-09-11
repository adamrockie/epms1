<?php
require "config.php";


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

use Database\Models\Heads;

//require $_SERVER['DOCUMENT_ROOT'].'/login_api/middlewares/Auth.php';
//require __DIR__.'/middlewares/Auth.php';

$allHeaders = getallheaders();

$head = Heads::where('office_id', '=', $id)->with('staff')->with('office')->first();


if($head) :
    echo json_encode([
        'success' => 1,
        'data' => $head,
    ]);
else :
    echo json_encode([
        'success' => 0,
        'message' => 'No Result Found!',
    ]);
endif;

?>