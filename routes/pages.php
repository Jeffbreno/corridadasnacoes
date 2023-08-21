<?php

use App\Http\Response;
use App\Controller\Pages;
use App\Controller\Pages\SendMailController;

//ROTA HOME
$obRouter->get('/', [
    function () {
        return new Response(200, Pages\HomeController::getHome());
    }
]);

//ROTA INSCRIÇÃO
$obRouter->post('/cadastrar/inscricao', [
    function ($request) {
        return new Response(200, Pages\InscricoesController::getHome($request));
    }
]);

//ROTA INSCRIÇÃO
$obRouter->post('/enviar/inscricao', [
    function ($request) {
        return new Response(200, Pages\InscricoesController::getNewIncricao($request));
    }
]);


//ROTA INSCRIÇÃO
$obRouter->get('/tipo/inscricao', [
    function () {
        return new Response(200, Pages\InscricoesController::getTipoInscricao());
    }
]);

//ROTA INSCRIÇÃO
$obRouter->post('/inscricao/confirmada', [
    function ($request) {
        return new Response(200, Pages\InscricoesController::getConfirmeInscricao($request));
    }
]);
