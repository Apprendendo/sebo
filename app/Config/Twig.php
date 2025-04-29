<?php

namespace App\Config;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Twig {
    private $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../views');
        $this->twig = new Environment($loader, [
            'cache' => false,
            'debug' => true,
            'auto_reload' => true,
        ]);
    }

    public function carregarTwig()
    {
        return $this->twig;
    }
}