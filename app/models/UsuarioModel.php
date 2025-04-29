<?php

namespace App\Models;
use PDO;
class UsuarioModel {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
        $this->criarTabelaSeNaoExistir();
    }

    private function criarTabelaSeNaoExistir() {
        $query = "
            CREATE TABLE IF NOT EXISTS usuarios (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nome VARCHAR(100) NOT NULL,
                email VARCHAR(100) UNIQUE NOT NULL,
                senha VARCHAR(255) NOT NULL,
                data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ";
        $this->db->exec($query);
    }

    public function salvar($nome, $email, $senha = null, $id = null) {
        if ($id) {
            return $this->atualizar($id, $nome, $email, $senha);
        }
        return $this->criar($nome, $email, $senha);
    }

    private function criar($nome, $email, $senha) {
        $query = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$nome, $email, password_hash($senha, PASSWORD_DEFAULT)]);
    }

    private function atualizar($id, $nome, $email, $senha = null) {
        if ($senha) {
            $query = "UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?";
            $params = [$nome, $email, password_hash($senha, PASSWORD_DEFAULT), $id];
        } else {
            $query = "UPDATE usuarios SET nome = ?, email = ? WHERE id = ?";
            $params = [$nome, $email, $id];
        }
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    public function buscarPorEmail($email) {
        return $this->buscarUnico("SELECT * FROM usuarios WHERE email = ?", [$email]);
    }

    public function buscarPorNome($nome) {
        return $this->buscarMultiplos("SELECT * FROM usuarios WHERE nome LIKE ?", ['%' . $nome . '%']);
    }

    public function buscarPorNomeOuEmail($termo) {
        return $this->buscarMultiplos(
            "SELECT * FROM usuarios WHERE nome LIKE ? OR email LIKE ?",
            ['%' . $termo . '%', '%' . $termo . '%']
        );
    }

    public function validarSenha($email, $senha) {
        $usuario = $this->buscarPorEmail($email);
        return $usuario && password_verify($senha, $usuario['senha']);
    }

    public function listar($limite = 10, $offset = 0) {
        $query = "SELECT * FROM usuarios LIMIT ? OFFSET ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $limite, PDO::PARAM_INT);
        $stmt->bindParam(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contar() {
        return $this->db->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
    }

    public function listarTodos() {
        return $this->buscarMultiplos("SELECT * FROM usuarios");
    }

    public function buscarPorId($id) {
        return $this->buscarUnico("SELECT * FROM usuarios WHERE id = ?", [$id]);
    }

    public function deletar($id) {
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }

    private function buscarUnico($query, $params = []) {
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function buscarMultiplos($query, $params = []) {
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}