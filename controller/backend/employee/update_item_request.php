<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Database\Models\ItemRequests;
use Database\Models\ItemSerialNumber;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if ($user->isLoggedIn()) {
    $id = Input::get('id');
    $inventory_id = Input::get('item_id');

    // Fetch existing record
    $record = ItemRequests::where('id', $id)->first();
    if (!$record) {
        echo json_encode(['status' => 'error', 'msg' => 'Record not found.']);
        exit;
    }

    $status  = Input::get('status');
    $comment = Input::get('comment');
    $ippis   = Input::get('ippis'); 

    // Update request record
    $saved = ItemRequests::where('id', $id)
        ->update([
            'status'  => $status,
            'comment' => $comment
        ]);

    // DELETE existing serials for this request first
    ItemSerialNumber::where('item_request_id', $id)->delete();

    // INSERT new ones
    $serialNumbers = Input::get('serial_numbers'); 

    if (!empty($serialNumbers) && is_array($serialNumbers)) {
        foreach ($serialNumbers as $serial) {
            if (!empty($serial)) {
                ItemSerialNumber::create([
                    'item_request_id' => $id,
                    'inventory_id'    => $inventory_id,
                    'ippis'           => $ippis,
                    'serial_number'   => $serial
                ]);
            }
        }
    }

    if ($saved) {
        echo json_encode(['status' => 'success', 'msg' => 'Request updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'An error occurred, Request information could not be updated.']);
    }
}
?>