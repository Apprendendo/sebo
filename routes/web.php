<?php

// Criação de rotas
// Aqui você pode adicionar suas rotas
// Boa prática: separar as rotas em um arquivo separado
switch ($path) {
    case '/':
        echo $twig->render('index.twig', []); // Renderiza a página inicial
        break;
    case '':
        echo $twig->render('index.twig', []); // Renderiza a página inicial
        break;
    case '/tipos':
        $tipoController->index();
        break;
    case '/tipos/criar':
        $tipoController->criar();
        break;
    case (preg_match('/\/tipos\/editar\/(\d+)/', $path, $matches) ? true : false):
        $tipoController->editar($matches[1]);
        break;
    case (preg_match('/\/tipos\/excluir\/(\d+)/', $path, $matches) ? true : false):
        $tipoController->excluir($matches[1]);
        break;
    case '/produtos':
        $produtoController->index();
        break;
    case '/produtos/criar':
        $produtoController->criar();
        break;
    case (preg_match('/\/produtos\/editar\/(\d+)/', $path, $matches) ? true : false):
        $produtoController->editar($matches[1]);
        break;
    case (preg_match('/\/produtos\/excluir\/(\d+)/', $path, $matches) ? true : false):
        $produtoController->excluir($matches[1]);
        break;
    case '/usuarios':
        $usuarioController->index();
        break;
    case '/usuarios/criar':
        $usuarioController->salvar($_POST); // Passa os dados do formulário como argumento
        break;
    case (preg_match('/\/usuarios\/editar\/(\d+)/', $path, $matches) ? true : false):
        $usuarioController->salvar($matches[1]);
        break;
    case (preg_match('/\/usuarios\/excluir\/(\d+)/', $path, $matches) ? true : false):
        $usuarioController->excluir($matches[1]);
        break;
    case '/login':
        $usuarioController->login();
        break;
    case '/logout':
        $usuarioController->logout();
        break;
    case '/registrar':
        $usuarioController->salvar($_POST);
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