<?php

class Database {
    private $host = 'localhost';
    private $port = 3308;
    private $dbname = 'if0_38511592_app_sebo';
    private $username = 'root';
    private $password = '123';

    public function conectar() {
        try {
            $pdo = new PDO(
                "mysql:host={$this->host};port={$this->port};dbname={$this->dbname};charset=utf8",
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