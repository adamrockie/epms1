<?php
require "config.php";


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

use Database\Models\Documents;

//require $_SERVER['DOCUMENT_ROOT'].'/login_api/middlewares/Auth.php';
//require __DIR__.'/middlewares/Auth.php';

$allHeaders = getallheaders();

$docs = Documents::where('ippis', '=', $id)->with('type')->get();//->toArray();


if($docs) :
    echo json_encode([
        'success' => 1,
        'data' => $docs,
    ]);
else :
    echo json_encode([
        'success' => 0,
        'message' => 'No Result Found!',
    ]);
endif;

?>