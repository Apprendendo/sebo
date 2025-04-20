<?php
class ProdutoModel {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }

    public function criar($dados) {
        $sql = "INSERT INTO produtos (titulo, autor, ano_publicacao, estado, preco, tipo_id) 
                VALUES (:titulo, :autor, :ano, :estado, :preco, :tipo_id)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':titulo' => $dados['titulo'],
            ':autor' => $dados['autor'],
            ':ano' => $dados['ano_publicacao'],
            ':estado' => $dados['estado'],
            ':preco' => $dados['preco'],
            ':tipo_id' => $dados['tipo_id']
        ]);
        return $this->db->lastInsertId();
    }

    public function listar() {
        $stmt = $this->db->query("
            SELECT p.*, t.nome as tipo_nome 
            FROM produtos p 
            JOIN tipos_produto t ON p.tipo_id = t.id 
            ORDER BY p.created_at DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("
            SELECT p.*, t.nome as tipo_nome 
            FROM produtos p 
            JOIN tipos_produto t ON p.tipo_id = t.id 
            WHERE p.id = :id
        ");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $dados) {
        $sql = "UPDATE produtos SET 
                titulo = :titulo,
                autor = :autor,
                ano_publicacao = :ano,
                estado = :estado,
                preco = :preco,
                tipo_id = :tipo_id
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':titulo' => $dados['titulo'],
            ':autor' => $dados['autor'],
            ':ano' => $dados['ano_publicacao'],
            ':estado' => $dados['estado'],
            ':preco' => $dados['preco'],
            ':tipo_id' => $dados['tipo_id'],
            ':id' => $id
        ]);
    }

    public function excluir($id) {
        $stmt = $this->db->prepare("DELETE FROM produtos WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function listarTipos() {
        // Example implementation for listing types
        $query = "SELECT * FROM tipos_produto";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}