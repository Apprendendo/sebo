<?php
namespace App\Controllers;

use App\Models\TipoModel;
class TipoController {
    private $model;
    private $twig;

    public function __construct($twig, $pdo) {
        $this->model = new TipoModel($pdo);
        $this->twig = $twig;
    }

    private function redirecionar(){
        $referer = '/sebo/public/tipos' ?? $_SERVER['HTTP_REFERER'];
        header("Location: $referer");
        exit;
    }

    private function render($url){
        return $this->twig->render($url, [
            'tipos' => $this->model->listarTodos()]
        );
    }

    public function index() {
        echo $this->render('tipos/index.twig');
    }

    public function criar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->salvar($_POST);
            $this->redirecionar();
        }
        echo $this->twig->render('tipos/criar.twig');
    }

    public function editar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST['id'] = $id;
            $this->model->salvar($_POST);
            $this->redirecionar();
        }
        $tipo = $this->model->buscarPorId($id);
        echo $this->twig->render('tipos/editar.twig', ['tipo' => $tipo]);
    }

    public function excluir($id) {
        $this->model->excluir($id);
        $this->redirecionar();
    }
}