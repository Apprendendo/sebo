<?php
require_once __DIR__ . '/../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Tests\Config\Database;
use App\Config\Twig;
use Routes\Web;

use App\Controllers\ProdutoController;
use App\Controllers\TipoController;
use App\Controllers\UsuarioController;

// Configuração do banco de dados
$db = new Database();
$pdo = $db->conectar();

// Configuração do Twig
$twigConfig = new Twig();
$twig = $twigConfig->carregarTwig();


// Configuração de rotas
$controllers = [
    'produto' => new ProdutoController($twig, $pdo),
    'tipo' => new TipoController($twig, $pdo),
    'usuario' => new UsuarioController($twig, $pdo)
];


$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remover o prefixo "/sebo/public/" se necessário
$basePath = '/sebo/public';
if (strpos($path, $basePath) === 0) {
    $path = substr($path, strlen($basePath));
}

// Verificar se a rota existe e chamar o controlador correspondente
$web = new Web($path, $twig, $controllers);