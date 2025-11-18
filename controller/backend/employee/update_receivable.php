<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Database\Models\Receiveable;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if ($user->isLoggedIn()) {
    $id = Input::get('id');

    // Fetch existing record
    $record = Receiveable::where('id', $id)->first();
    if (!$record) {
        echo json_encode(['status' => 'error', 'msg' => 'Record not found.']);
        exit;
    }

    $contract      = Sanitize::sanitize(Input::get('contract'));
    $contractor    = Sanitize::sanitize(Input::get('contractor'));
    $lot_number    = Sanitize::sanitize(Input::get('lot_number'));
    $status        = Sanitize::sanitize(Input::get('status'));
    $email         = Sanitize::sanitize(Input::get('email'));
    $phone_number  = Sanitize::sanitize(Input::get('phone_number'));
    $date          = Sanitize::sanitize(Input::get('date'));
    $description   = Sanitize::sanitize(Input::get('description'));
    
    $upload        = $record->upload; // default to existing image
    $upload_status = '0';

    /**
     * Upload Script Starts here
     */
    $uploads = $_SERVER['DOCUMENT_ROOT'] . "/epms1/uploads/receive/";

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
    $saved = Receiveable::where('id', '=', $id)
        ->update([
            'contract'     => $contract,
            'contractor'   => $contractor,
            'lot_number'   => $lot_number,
            'status'       => $status,
            'email'        => $email,
            'phone_number' => $phone_number,
            'date'         => $date,
            'upload'       => $upload,
            'description'  => $description,
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
