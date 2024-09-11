<?php
require "config.php";
require_once 'twig.php';




echo $twig->render('frontend/about.html.twig', [
    'name' => 'John Doe', 
    'occupation' => 'gardener',
    'title' => 'About us'
    ]);


?>