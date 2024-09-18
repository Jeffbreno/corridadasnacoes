<?php

use App\Http\Response;
use App\Controller\Admin;

//ROTA DA LISTAGEM DE USUÁRIOS
$obRouter->get('/admin/categorias', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\CategoriasController::getCategorias($request));
    }
]);

//ROTA DE CADASTRO DE USUÁRIO
$obRouter->get('/admin/categorias/new', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\CategoriasController::getNewCategorias($request));
    }
]);

//ROTA DE CADASTRO DE USUÁRIO
$obRouter->post('/admin/categorias/new', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\CategoriasController::setNewCategorias($request));
    }
]);

//ROTA DE EDIÇÃO DE USUÁRIO
$obRouter->get('/admin/categorias/{id}/edit', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Admin\CategoriasController::getEditCategorias($request, $id));
    }
]);


//ROTA DE EDIÇÃO DE USUÁRIO
$obRouter->post('/admin/categorias/{id}/edit', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Admin\CategoriasController::setEditCategorias($request, $id));
    }
]);

//ROTA DE EXCLUSÃO DE USUÁRIO
$obRouter->get('/admin/categorias/{id}/delete', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Admin\CategoriasController::getDeleteCategorias($request, $id));
    }
]);

//ROTA DE EXCLUSÃO DE USUÁRIO
$obRouter->post('/admin/categorias/{id}/delete', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Admin\CategoriasController::setDeleteCategorias($request, $id));
    }
]);
