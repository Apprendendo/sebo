<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Tests\Config\Database;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuração do banco de dados
$db = new Database();
$pdo = $db->conectar();
var_dump($pdo); // Verificar se o objeto PDO foi criado

// Configuração do Twig
$twigConfig = new Twig();
$twig = $twigConfig->carregarTwig();

// Renderizar a página inicial
echo $twig->render('index.twig', ['title' => 'Sebo Online']);

// Configuração de rotas
$produtoController = new ProdutoController($twig, $pdo);
$tipoController = new TipoController($twig, $pdo);
$usuarioController = new UsuarioController($twig, $pdo);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remover o prefixo "/sebo/public/" se necessário
$basePath = '/sebo/public';
if (strpos($path, $basePath) === 0) {
    $path = substr($path, strlen($basePath));
}

var_dump($path); // Verificar o valor de $path

include_once __DIR__ . '/../routes/web.php';