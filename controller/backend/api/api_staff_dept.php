<?php
require "config.php";


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


use Database\Models\Posting;


$allHeaders = getallheaders();

$staff = Posting::where([
    ['ippis', '=', $id],
    ['status', '=', 'approved'],
    ])->with('office')->with('unit')->get()->sortByDesc('start_date')->first();


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