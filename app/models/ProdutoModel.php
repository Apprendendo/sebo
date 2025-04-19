<?php
class Produto {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    
    public function criar($dados) {
        $sql = "INSERT INTO produtos (titulo, autor, ano_publicacao, estado, preco, tipo_id) 
                VALUES (:titulo, :autor, :ano, :estado, :preco, :tipo_id)";
        // Implementação do prepared statement
    }
    
    public function listar() {
        return $this->db->query("
            SELECT p.*, t.nome as tipo_nome 
            FROM produtos p 
            JOIN tipos_produto t ON p.tipo_id = t.id 
            ORDER BY p.created_at DESC
        ");
    }
}