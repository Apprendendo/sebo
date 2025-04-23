<?php
// public/index.php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/twig.php';
require_once __DIR__ . '/../app/controllers/ProdutoController.php';
require_once __DIR__ . '/../app/controllers/TipoController.php';

// Configuração do banco de dados
$db = new Database();
$pdo = $db->conectar();

// Configuração do Twig
$twig = carregarTwig();

// Rotas para Produtos
$produtoController = new ProdutoController($twig, $pdo);
// Rotas para Tipos
$tipoController = new TipoController($twig, $pdo);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remover o prefixo "/sebo/public/"
$basePath = '/sebo/public';
if (strpos($path, $basePath) === 0) {
    $path = substr($path, strlen($basePath));
}

include_once __DIR__ . '/../routes/web.php';