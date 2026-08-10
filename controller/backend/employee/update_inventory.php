<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Database\Models\Inventory;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if ($user->isLoggedIn()) {
    $id = Input::get('id');

    

    // Fetch existing record
    $record = Inventory::where('id', $id)->first();
    if (!$record) {
        echo json_encode(['status' => 'error', 'msg' => 'Record not found.']);
        exit;
    }

    $inventory      = Sanitize::sanitize(Input::get('inventory'));
    $item_type  = Sanitize::sanitize(Input::get('item_type'));
    $amount         = Sanitize::sanitize(Input::get('amount'));
    $status        = Sanitize::sanitize(Input::get('status'));
    $warranty       = Sanitize::sanitize(Input::get('warranty'));
    $life_span      = Sanitize::sanitize(Input::get('life_span'));
    $item_type      = Sanitize::sanitize(Input::get('item_type'));
    $category      = Sanitize::sanitize(Input::get('category'));
    $serial_no       = Sanitize::sanitize(Input::get('serial_no'));
    $date           = Sanitize::sanitize(Input::get('date'));
    $upload         = $record->upload; // default to existing image


    /**
     * Upload Script Starts here
     */
    $uploads = $_SERVER['DOCUMENT_ROOT'] . "/epms1/uploads/inventory/";

    if (!empty($_FILES["upload"]["name"])) {
        $validextensions = ["jpg", "jpeg", "png"];
        $temporary = explode(".", $_FILES["upload"]["name"]);
        $file_extension = strtolower(end($temporary));

        if ($_FILES["upload"]["error"] === 0 && in_array($file_extension, $validextensions)) {
            $file_name = uniqid(); 
            if (move_uploaded_file($_FILES["upload"]["tmp_name"], $uploads . $file_name . '.' . $file_extension)) {
                $upload = $file_name . '.' . $file_extension;
                $upload_status = '1';
            }
        }
    }

    // Update record
    $saved = Inventory::where('id', '=', $id)
        ->update([
           'inventory'         => $inventory,
           'item_type'          => $item_type, 
            'amount'            => $amount,
            'status'           => $status,
            'warranty'          => $warranty,
            'life_span'         => $life_span,
            'item_type'         => $item_type,
            'category'         => $category,
            'serial_no'          => $serial_no,
            'date'              => $date,
            'upload'            => $upload,
        ]);

    /**
     * Upload Script Ends here 
     */

    if ($saved) {
        echo json_encode(['status' => 'success', 'msg' => 'Contract information updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'An error occurred, contract information could not be updated.']);
    }
}
?>