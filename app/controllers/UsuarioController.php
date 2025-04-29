<?php
namespace App\Controllers;

use App\Models\UsuarioModel;

class UsuarioController {
    private $model;
    private $twig;

    public function __construct($twig, $pdo) {
        $this->model = new UsuarioModel($pdo);
        $this->twig = $twig;
    }

    // List all users
    public function index() {
        $usuarios = $this->model->listarTodos();
        echo $this->twig->render('usuarios/index.twig', ['usuarios' => $usuarios]);
    }

    private function verificar($usuario, $mensagem, $erro = null, $pagina = 'usuarios/index.twig', $paginaErr = 'usuarios/error.twig') {
        if ($usuario) {
            $dados = ['usuario' => $usuario, 'message' => $mensagem];
            echo $this->twig->render($pagina, $dados);
        } else {
            $dados = ['message' => $erro];
            echo $this->twig->render($paginaErr, $dados);
        }
    }
    

    // Show a specific user by ID
    public function mostrar($id)
    {
        $usuario = $this->model->buscarPorId($id);
        $this->verificar($usuario, 'Usuário encontrado com sucesso', 'Usuário não encontrado');
    }

    // Create a new user
    public function salvar($data) {
        $usuario = $this->model->salvar($data);
        $this->verificar($usuario, 'Usuário encontrado com sucesso', 'Usuário não encontrado');
    }

    // Update an existing user
    public function atualizar($id, $data) {
        $usuario = $this->model->salvar($id, $data);
        $this->verificar( $usuario, 'Usuário encontrado com sucesso', 'Usuário não encontrado');
    }

    // Delete a user
    public function excluir($id) {
        $usuario = $this->model->deletar($id);
        $this->verificar($usuario,  'Usuário encontrado com sucesso', 'Usuário não encontrado');
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $this->efetuarLogin($email, $senha);
        } else {
            echo $this->twig->render('login.twig');
        }
    }

    // Login user
    public function efetuarLogin($email, $senha) {
        $usuario = $this->model->validarSenha($email, $senha);
        $this->verificar($usuario, 'Login realizado com sucesso', 'Email ou senha inválidos', 'index.twig', 'error.twig');
    }

    // Logout user
    public function logout() {
        session_start();
        session_destroy();
        header('Location: /sebo/public/login');
        exit;
    }
}