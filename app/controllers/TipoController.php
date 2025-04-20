<?php
// app/controllers/TipoController.php
require_once __DIR__ . '/../models/TipoModel.php';

class TipoController {
    private $model;
    private $twig;

    public function __construct($twig, $pdo) {
        $this->model = new TipoModel($pdo);
        $this->twig = $twig;
    }

    public function index() {
        $tipos = $this->model->listarTodos();
        echo $this->twig->render('tipos/index.twig', ['tipos' => $tipos]);
    }

    public function criar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->salvar($_POST);
            header("Location: /tipos");
            exit;
        }
        echo $this->twig->render('tipos/criar.twig');
    }

    public function editar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST['id'] = $id;
            $this->model->salvar($_POST);
            header("Location: /tipos");
            exit;
        }
        $tipo = $this->model->buscarPorId($id);
        echo $this->twig->render('tipos/editar.twig', ['tipo' => $tipo]);
    }

    public function excluir($id) {
        $this->model->excluir($id);
        header("Location: /tipos");
        exit;
    }
}