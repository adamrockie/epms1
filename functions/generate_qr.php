<?php

$id = $_GET['data'] ?? '';

$url = "http://127.0.0.1/epms1/view_request/" . $id;

header("Location: https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=" . urlencode($url));
exit;