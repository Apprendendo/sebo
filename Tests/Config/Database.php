<?php
namespace Tests\Config;

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
            // Depuração: Exibir informações de conexão
            echo "Tentando conectar ao banco de dados: {$this->dbname} em {$this->host}:{$this->port}<br>";

            $pdo = new PDO(
                "mysql:host={$this->host};port={$this->port};dbname={$this->dbname};charset={$this->charset}",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_TIMEOUT => 2 // Timeout curto para testes
                ]
            );

            // Depuração: Conexão bem-sucedida
            echo "Conexão bem-sucedida!<br>";
            return $pdo;
        } catch (PDOException $e) {
            // Depuração: Exibir mensagem de erro detalhada
            die("Erro de conexão: " . $e->getMessage());
        }
    }
}

// Testar a conexão
$db = new Database();
$pdo = $db->conectar();

// Depuração: Verificar se o objeto PDO foi criado
if ($pdo instanceof PDO) {
    echo "Objeto PDO criado com sucesso.<br>";
} else {
    echo "Falha ao criar o objeto PDO.<br>";
}