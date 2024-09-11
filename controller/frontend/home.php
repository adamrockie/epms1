<?php
require "config.php";
require_once 'twig.php';



echo $twig->render('frontend/home.html.twig', ['name' => 'John Doe', 
    'occupation' => 'gardener']);



?>