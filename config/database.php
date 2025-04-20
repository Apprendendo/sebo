<?php
// config/database.php
// Vamos colocar os dados de conexão ao banco, de maneira a qual o GitHub considere seguro.
$host = 'localhost';
$port = 3307;
$dbname = 'if0_38511592_app_sebo';
$username = 'root';
$password = '123';
$password = '123';

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8",
        $username, 
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 2 // Timeout curto para testes
        ]
    );
    return $pdo;
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}