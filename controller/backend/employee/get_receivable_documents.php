<?php

require "config.php";

use Classes\User;
use Classes\Session;
use Classes\Config;
use Database\Models\Receiveable;
use Database\Models\ReceivableDocument;

$sessionName = Config::get('session/session_name');
$uid = Session::get($sessionName);

$user = new User();

header('Content-Type: application/json');

if ($user->isLoggedIn()) {

    $id = $params['id'] ?? null;

    $receivable = Receiveable::find($id);
    $documents  = ReceivableDocument::where('receivable_id', $id)->get();

    echo json_encode([
        'status'    => $receivable->status ?? null,
        'documents' => $documents,
    ]);
}

?>