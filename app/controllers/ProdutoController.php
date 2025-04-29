<?php
namespace App\Controllers;

use App\Models\ProdutoModel;

class ProdutoController {
    private $model;
    private $twig;

    public function __construct($twig, $database) {
        $this->model = new ProdutoModel($database);
        $this->twig = $twig;
    }

    private function redirecionar(){
        $referer = '/sebo/public/produtos' ?? $_SERVER['HTTP_REFERER'];
        header("Location: $referer");
        exit;
    }

    private function render($url, $data = []) {
        echo $this->twig->render($url, $data);
    }

    public function index() {
        $produtos = $this->model->listar();
        $tipos = $this->model->listarTipos(); // Você precisará implementar este método
        $this->render('produtos/index.twig', [
            'produtos' => $produtos,
            'tipos' => $tipos
        ]);
    }

    public function criar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar e salvar os dados do produto
            $this->model->criar($_POST);

            // Redirecionar para a lista de produtos
            $this->redirecionar();
        }

        // Renderizar o formulário de criação
        // Obter a lista de tipos para o formulário
        $tipos = $this->model->listarTipos();
        $this->render('produtos/criar.twig', [
            'tipos' => $tipos
        ]);
    }

    public function editar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->atualizar($id, $_POST);
            $this->redirecionar();
        }

        // Renderizar o formulário de edição
        // Obter o produto a ser editado
        $produto = $this->model->buscarPorId($id);

        // Obter a lista de tipos para o formulário
        $tipos = $this->model->listarTipos();
        $this->render('produtos/editar.twig', [
            'produto' => $produto,
            'tipos' => $tipos
        ]);
    }

    public function excluir($id) {
        $this->model->excluir($id);
        $this->redirecionar();
    }
}