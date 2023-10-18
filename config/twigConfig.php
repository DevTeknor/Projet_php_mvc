<?php

require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('App/views');
$twig = new \Twig\Environment($loader, [
    'cache' => false
]);