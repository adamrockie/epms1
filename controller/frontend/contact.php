<?php
require "config.php";
require_once 'twig.php';



echo $twig->render('frontend/contact.html.twig', [
    'name' => 'John Doe', 
    'occupation' => 'gardener',
    'title' => 'Contact Us'
    ]);



?>