<?php
require_once __DIR__ . '/../models/ProdutoModel.php';

class ProdutoController {
    private $model;
    private $twig;

    public function __construct($twig, $database) {
        $this->model = new ProdutoModel($database);
        $this->twig = $twig;
    }

    public function index() {
        $produtos = $this->model->listar();
        $tipos = $this->model->listarTipos(); // Você precisará implementar este método
        echo $this->twig->render('produtos/index.twig', [
            'produtos' => $produtos,
            'tipos' => $tipos
        ]);
    }

    public function criar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->criar($_POST);
            header("Location: /produtos");
            exit;
        }
        $tipos = $this->model->listarTipos();
        echo $this->twig->render('produtos/criar.twig', ['tipos' => $tipos]);
    }

    public function editar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->atualizar($id, $_POST);
            header("Location: /sebo/public/produtos");
            exit;
        }
        $produto = $this->model->buscarPorId($id);
        $tipos = $this->model->listarTipos();
        echo $this->twig->render('/produtos/editar.twig', [
            'produto' => $produto,
            'tipos' => $tipos
        ]);
    }

    public function excluir($id) {
        $this->model->excluir($id);
        header("Location: /sebo/public/produtos");
        exit;
    }
}