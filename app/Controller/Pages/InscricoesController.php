<?php

namespace App\Controller\Pages;

use App\Http\Request;
use App\Utils\View;
use App\Model\Entity\Inscricao as EntiyInscricao;
use App\Model\Entity\Categoria as EntityCategoria;

class InscricoesController extends PageController
{

    /**
     * Método reponsável por retornar mensagem de status
     *
     */
    private static function getStatus(Request $request)
    {
        #QUERY PARAMS
        $queryParams = $request->getQueryParams();

        if (!isset($queryParams['status'])) return '';

        #MENSAGEM DE STATUS
        switch ($queryParams['status']) {
            case 'created':
                return AlertController::getSuccess('Depoimento criado com sucesso!');
            case 'update':
                return AlertController::getSuccess('Depoimento atualizado com sucesso!');
            case 'deleted':
                return AlertController::getSuccess('Depoimento excluído com sucesso!');
        }
    }

    private static function getInscricao($categoria)
    {
        if ($categoria == '3') {
            $content = View::render('pages/inscricao/index.kids', ['categoria' => $categoria]);
        } else {
            $content = View::render('pages/inscricao/index', ['categoria' => $categoria]);
        }
        return $content;
    }

    private static function getSelectInscricao()
    {
        $obCategoria = EntityCategoria::all();
        $categorias = '';

        foreach ($obCategoria as $categoria) {
            $categorias .= '<li class="list-group-item">
            <label> <input type="radio" name="categoria" value="' . $categoria->id . '" required /> ' . $categoria->titulo . ' </label>
          </li>';
        }
        return View::render('pages/inscricao/select-inscricao', ['categorias' => $categorias]);
    }

    public static function getHome(Request $request)
    {
        $postVars = $request->getPostVars();
        $postVars = $request->getPostVars();
        $categoria = $postVars['categoria'] ?? '';

        $content = self::getInscricao($categoria);

        return parent::getPageTelas('&raquo;Inscrição', $content);
    }

    public static function getTipoInscricao()
    {
        $content = self::getSelectInscricao();

        return parent::getPageTelas('&raquo;Tipo Inscrição', $content);
    }

    public static function getNewIncricao(Request $request)
    {
        $postVars = $request->getPostVars();
        $data_cadastro = date('Y-m-d H:i:s');
        //DADOS DO POST
        $obInscricao = new EntiyInscricao;

        $obInscricao->nome = $postVars['nome'];
        //EM CASO DE RESPONSAVEL
        $obInscricao->nome_responsavel = $postVars['nome_responsavel'] ?? NULL;
        $obInscricao->email = $postVars['email'];
        $obInscricao->cpf = $postVars['cpf'];
        $obInscricao->categoria = $postVars['categoria'];
        $obInscricao->genero = $postVars['genero'];
        $obInscricao->dt_nascimento = $postVars['dt_nascimento'];
        $obInscricao->celular = $postVars['celular'];
        $obInscricao->logradouro = $postVars['logradouro'];
        $obInscricao->numero = $postVars['numero'];
        $obInscricao->complemento = $postVars['complemento'];
        $obInscricao->bairro = $postVars['bairro'];
        $obInscricao->cidade = $postVars['cidade'];
        $obInscricao->uf = $postVars['uf'];
        $obInscricao->distancia = $postVars['distancia'];
        $obInscricao->camisa = $postVars['camisa'];
        $obInscricao->equipe = $postVars['equipe'];
        $obInscricao->dt_cadastro = $data_cadastro;

        $obInscricao->save();

        $atleta = $obInscricao->where('dt_cadastro', $data_cadastro)->first();
        $ticket = str_pad($atleta->id, 4, '0', STR_PAD_LEFT);

        $obmail = new SendMailController;
        $obmail->sendMail($atleta, $ticket);

        return self::getConfirmeInscricao($request, $ticket);
    }

    public static function getBotao($categoria): string
    {
        $obCategoria = EntityCategoria::find($categoria);
        return $obCategoria->link_pagamento;
    }

    public static function getConfirmeInscricao(Request $request, $ticket = null): string
    {
        $postVars = $request->getPostVars();

        $nome = $postVars['nome'];
        $email = $postVars['email'];

        if ($postVars['categoria'] == 4) {
            #CONTEÚDO
            $content = View::render('pages/inscricao/confirmar.promocional', [
                'ticket' => str_pad($ticket, 4, '0', STR_PAD_LEFT),
                'nome' => $nome,
                'email' => $email,
                'botaoPagseguro' => self::getBotao($postVars['categoria'])
            ]);
        } else {
            #CONTEÚDO
            $content = View::render('pages/inscricao/confirmar', [
                'ticket' => str_pad($ticket, 4, '0', STR_PAD_LEFT),
                'nome' => $nome,
                'email' => $email,
                'botaoPagseguro' => self::getBotao($postVars['categoria'])
            ]);
        }

        return parent::getPageTelas('&raquo;Confirmar', $content);
    }
}
