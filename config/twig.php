<?php
require_once __DIR__ . '/../vendor/autoload.php';

var_dump(__DIR__.'/../app/views');

function carregarTwig() {
    $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../app/views');
    $twig = new \Twig\Environment($loader, [
        'cache' => false,
        'debug' => true,
        'auto_reload' => true,
    ]);
    return $twig;
}