<?php
// config/database.php
// Vamos colocar os dados de conexão ao banco, de maneira a qual o GitHub considere seguro.
$host = 'localhost';
$dbname = 'nome_do_banco';
$username = 'usuario';
$password = 'senha';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}