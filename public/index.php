<?php
// public/index.php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/twig.php';
require_once __DIR__ . '/../app/controllers/ProdutoController.php';

$pdo = conectarBanco();
$twig = carregarTwig();

$controller = new ProdutoController($twig, $pdo);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($path) {
    case '/produtos':
        $controller->index();
        break;
    case '/produtos/criar':
        $controller->criar();
        break;
    case (preg_match('/\/produtos\/editar\/(\d+)/', $path, $matches) ? true : false):
        $controller->editar($matches[1]);
        break;
    case (preg_match('/\/produtos\/excluir\/(\d+)/', $path, $matches) ? true : false):
        $controller->excluir($matches[1]);
        break;
    default:
        http_response_code(404);
        echo 'Página não encontrada';
        break;
}