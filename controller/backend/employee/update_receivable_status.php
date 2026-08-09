<?php
require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Classes\Input;
use Classes\Sanitize;
use Classes\Token;
use Database\Models\Receiveable;
use Database\Models\ReceivableDocument;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();

if ($user->isLoggedIn() && Token::check(Input::get('token'))) {

    $receivable_id = Sanitize::sanitize(Input::get('receivable_id'));
    $status         = Sanitize::sanitize(Input::get('received_status'));

    if (!$receivable_id || !$status) {
        echo json_encode(['status' => 'error', 'msg' => 'Missing required fields.']);
        exit;
    }

    try {
        // Update main receivable status
        Receiveable::where('id', $receivable_id)->update(['status' => $status]);

        /**
         * Upload Script Starts here
         */
        $uploads = $_SERVER['DOCUMENT_ROOT'] . "/epms1/uploads/receive/";
        $validextensions = ["jpg", "jpeg", "png", "pdf"];

        if (!empty($_FILES['documents']['name'][0])) {

            foreach ($_FILES['documents']['name'] as $index => $original_name) {

                if ($_FILES['documents']['error'][$index] > 0) {
                    continue;
                }

                $temporary      = explode(".", $original_name);
                $file_extension = strtolower(end($temporary));

                if (!in_array($file_extension, $validextensions)) {
                    continue;
                }

                $file_name = uniqid();
                $tmp_name  = $_FILES['documents']['tmp_name'][$index];

                if (move_uploaded_file($tmp_name, $uploads . $file_name . '.' . $file_extension)) {

                    ReceivableDocument::create([
                        'receivable_id' => $receivable_id,
                        'document'      => $file_name . '.' . $file_extension,
                        'status'        => $status,
                    ]);
                }
            }
        }
        /**
         * Upload Script Ends here
         */

        echo json_encode(['status' => 'success', 'msg' => 'Receivable updated successfully.']);

    } catch (\Throwable $e) {
        error_log('update_receivable_status error: ' . $e->getMessage() . ' | ' . $e->getFile() . ':' . $e->getLine());
        echo json_encode(['status' => 'error', 'msg' => 'An error occurred, please try again.']);
    }
}

?>