<?php
require "config.php";

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

$data = $_GET['data'] ?? 'NO_DATA';

$qrCode = QrCode::create($data)->setSize(300);
$writer = new PngWriter();

header('Content-Type: image/png');
echo $writer->write($qrCode)->getString();