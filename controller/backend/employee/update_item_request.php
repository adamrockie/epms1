<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Database\Models\ItemRequests;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();
if ($user->isLoggedIn()) {
    $id = Input::get('id');

    

    // Fetch existing record
    $record = ItemRequests::where('id', $id)->first();
    if (!$record) {
        echo json_encode(['status' => 'error', 'msg' => 'Record not found.']);
        exit;
    }

    $status        = Input::get('status');
    $comment       = Input::get('comment');

    // Update record
    $saved = ItemRequests::where('id', '=', $id)
        ->update([
            'status'           => $status,
            'comment'          => $comment
        ]);

    /**
     * Upload Script Ends here 
     */

    if ($saved) {
        echo json_encode(['status' => 'success', 'msg' => 'Request updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'An error occurred, Request information could not be updated.']);
    }
}
?>