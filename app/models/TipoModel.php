<?php
namespace App\Models;
use PDO;
// app/models/TipoModel.php
class TipoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listarTodos() {
        $stmt = $this->pdo->query("SELECT * FROM tipos_produto ORDER BY nome");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM tipos_produto WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar($dados) {
        if (empty($dados['id'])) {
            $stmt = $this->pdo->prepare("INSERT INTO tipos_produto (nome) VALUES (?)");
            $stmt->execute([$dados['nome']]);
            return $this->pdo->lastInsertId();
        } else {
            $stmt = $this->pdo->prepare("UPDATE tipos_produto SET nome = ? WHERE id = ?");
            $stmt->execute([$dados['nome'], $dados['id']]);
            return $dados['id'];
        }
    }

    public function excluir($id) {
        $stmt = $this->pdo->prepare("DELETE FROM tipos_produto WHERE id = ?");
        return $stmt->execute([$id]);
    }
}