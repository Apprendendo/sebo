<?php
class ProdutoController {
    private $model;
    private $twig;
    
    public function __construct($twig) {
        $this->model = new Produto($database);
        $this->twig = $twig;
    }
    
    public function index() {
        $produtos = $this->model->listar();
        echo $this->twig->render('produtos/index.twig', ['produtos' => $produtos]);
    }
    
    public function criar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validação dos dados
            // Chamada do modelo
        }
        echo $this->twig->render('produtos/criar.twig');
    }
}