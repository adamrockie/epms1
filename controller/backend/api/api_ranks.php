<?php
require "config.php";


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

use Database\Models\Ranks;

$allHeaders = getallheaders();

$ranks = Ranks::all();


if($ranks) :
    echo json_encode([
        'success' => 1,
        'data' => $ranks,
    ]);
else :
    echo json_encode([
        'success' => 0,
        'message' => 'No Result Found!',
    ]);
endif;

?>