<?php
require "config.php";


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

use Database\Models\Units;

$allHeaders = getallheaders();

$unit = Units::where('unit_id', '=', $uid)->get()->toArray();//->with('rank')->with('state')->first();//->toArray();

if($unit) :
    echo json_encode([
        'success' => 1,
        'data' => $unit,
    ]);
else :
    echo json_encode([
        'success' => 0,
        'message' => 'No Result Found!',
    ]);
endif;

?>