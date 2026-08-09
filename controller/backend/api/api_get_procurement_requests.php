<?php
require "config.php";


use Database\Models\RequestItems;


header('Content-Type: application/json');

$requests = RequestItems::get()->toArray();;
if($requests) :
    echo json_encode([
        'success' => 1,
        'data'    => $requests
    ]);
else :
    echo json_encode([
        'success' => 0,
        'message' => 'No Result Found!',
    ]);
endif;

?>