<?php

use App\Http\Response;
use App\Controller\Admin;

//ROTA DA LISTAGEM DE DEPOIMENTOS
$obRouter->get('/admin/avisos', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\AvisosController::getAviso($request));
    }
]);

//ROTA DA LISTAGEM DE DEPOIMENTOS
$obRouter->get('/admin/inscritos/visualizar/{id}', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($id) {
        return new Response(200, Admin\InscricoesController::getModal($id));
    }
]);

//ROTA DE CADASTRO DE DEPOIMENTOS
$obRouter->get('/admin/inscritos/new', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\InscricoesController::getNewInscrito($request));
    }
]);

//ROTA DE CADASTRO DE DEPOIMENTOS
$obRouter->post('/admin/inscritos/new', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\InscricoesController::setNewInscrito($request));
    }
]);

//ROTA DE EDIÇÃO DE DEPOIMENTOS
$obRouter->get('/admin/inscritos/{id}/edit', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Admin\InscricoesController::getEditInscrito($request, $id));
    }
]);


//ROTA DE EDIÇÃO DE DEPOIMENTOS
$obRouter->post('/admin/inscritos/{id}/edit', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Admin\InscricoesController::setEditInscrito($request, $id));
    }
]);

//ROTA DE EXCLUSÃO DE DEPOIMENTOS
$obRouter->get('/admin/inscritos/{id}/delete', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Admin\InscricoesController::getDeleteInscrito($request, $id));
    }
]);

//ROTA DE EXCLUSÃO DE DEPOIMENTOS
$obRouter->post('/admin/inscritos/{id}/delete', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Admin\InscricoesController::setDeleteInscrito($request, $id));
    }
]);

//ROTA DE EXCLUSÃO DE DEPOIMENTOS
$obRouter->get('/admin/inscritos/{id}/pagamento', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request, $id) {
        return new Response(200, Admin\InscricoesController::setStatusPag($request, $id));
    }
]);
