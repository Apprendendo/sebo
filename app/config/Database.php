<?php

/** Informo aqui a configuração relacionada
 *  a conexão a Base de Dados, em PHP 
 * */
namespace App\Config;

use PDO;
use PDOException;

class Database {
    private $host = 'localhost';
    private $port = 3308;
    private $dbname = 'if0_38511592_app_sebo';
    private $username = 'root';
    private $password = '123';
    private $charset = 'utf8mb4';

    public function conectar() {
        try {
            $pdo = new PDO(
                "mysql:host={$this->host};port={$this->port};dbname={$this->dbname};charset={$this->charset}",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_TIMEOUT => 2 // Timeout curto para testes
                ]
            );
            return $pdo;
        } catch (PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
    }
}