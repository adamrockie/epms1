<?php
require "config.php";


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

use Database\Models\Posting;

$allHeaders = getallheaders();

$staff = Posting::where([['office_id', '=', $did],['status', '=', 'approved']])->with('office')->with('unit')->with('staff')->get()->sortByDesc('start_date')->toArray();

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