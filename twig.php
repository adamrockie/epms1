<?php

require 'vendor/autoload.php';

//require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';


use Twig\Environment as Environment;
use Twig\Loader\FilesystemLoader as FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);


?>