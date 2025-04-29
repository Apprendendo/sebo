<?php

namespace Routes;

// Criação de rotas
// Aqui você pode adicionar suas rotas
// Boa prática: separar as rotas em um arquivo separado

class Web {

    private $path;
    private $twig;
    private $controllers;

    public function __construct($path, $twig, $controllers) {
        $this->path = $path;
        $this->twig = $twig;
        $this->controllers = $controllers;

        $this->handleRoute();
    }
    
    
    private function handleRoute(){
        switch ($this->path) {
            case '/':
                echo $this->twig->render('index.twig', []); // Renderiza a página inicial
                break;
            case '':
                echo $this->twig->render('index.twig', []); // Renderiza a página inicial
                break;
            case '/tipos':
                $this->controllers['tipo']->index();
                break;
            case '/tipos/criar':
                $this->controllers['tipo']->criar();
                break;
            case (preg_match('/\/tipos\/editar\/(\d+)/', $path, $matches) ? true : false):
                $this->controllers['tipo']->editar($matches[1]);
                break;
            case (preg_match('/\/tipos\/excluir\/(\d+)/', $path, $matches) ? true : false):
                $this->controllers['tipo']->excluir($matches[1]);
                break;
            case '/produtos':
                $this->controllers['produto']->index();
                break;
            case '/produtos/criar':
                $this->controllers['produto']->criar();
                break;
            case (preg_match('/\/produtos\/editar\/(\d+)/', $path, $matches) ? true : false):
                $this->controllers['produto']->editar($matches[1]);
                break;
            case (preg_match('/\/produtos\/excluir\/(\d+)/', $path, $matches) ? true : false):
                $this->controllers['produto']->excluir($matches[1]);
                break;
            case '/usuarios':
                $this->controllers['usuario']->index();
                break;
            case '/usuarios/criar':
                $this->controllers['usuario']->salvar($_POST); // Passa os dados do formulário como argumento
                break;
            case (preg_match('/\/usuarios\/editar\/(\d+)/', $path, $matches) ? true : false):
                $this->controllers['usuario']->salvar($matches[1]);
                break;
            case (preg_match('/\/usuarios\/excluir\/(\d+)/', $path, $matches) ? true : false):
                $this->controllers['usuario']->excluir($matches[1]);
                break;
            case '/login':
                $this->controllers['usuario']->login();
                break;
            case '/logout':
                $this->controllers['usuario']->logout();
                break;
            case '/cadastrar':
                $this->controllers['usuario']->salvar($_POST);
                break;
        
            case '/404':
                http_response_code(404);
                echo 'Página não encontrada';
                break;
            case '/500':
                http_response_code(500);
                echo 'Erro interno do servidor';
                break;
            
                default:
                echo $twig->render('index.twig', []); // Renderiza a página inicial
                break;
        }
    }
}
