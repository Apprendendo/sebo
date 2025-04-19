<?php
require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../app/views');
$twig = new \Twig\Environment($loader, [
    'cache' => '../cache',
    'debug' => true,
]);