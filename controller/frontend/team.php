<?php
require "config.php";
require_once 'twig.php';



echo $twig->render('frontend/team.html.twig', [
    'name' => 'John Doe', 
    'occupation' => 'gardener',
    'title' => 'Our Team'
    ]);



?>