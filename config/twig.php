<?php
require_once __DIR__ . '/../vendor/autoload.php';

function carregarTwig() {
    $loader = new \Twig\Loader\FilesystemLoader('../app/views');
    $twig = new \Twig\Environment($loader, [
        'cache' => false,
        'debug' => true,
        'auto_reload' => true,
    ]);
    return $twig;
}