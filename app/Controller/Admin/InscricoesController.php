<?php

namespace App\Controller\Admin;

use App\Http\Request;
use App\Utils\View;
use App\Model\Entity\Inscricao as EntityIncritos;

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

    /** 
     * Método responsável por obter a renderização dos itens de depoimentos para a página
     * 
     */
    private static function getInscritoItems(Request $request, &$obPagination): string
    {
        //DEPOIMENTOS
        $resultItems = '';

        // RESULTADO DA PÁGINA
        $queryInscritos = EntityIncritos::orderBy('id', 'desc')->get();

        //Seta e Retorna intens por página
        $obPagination = PageController::setPaginator($request, $queryInscritos, 5);

        foreach ($obPagination as $inscrito) {
            $resultItems .= View::render('admin/inscritos/item', [
                'id' => $inscrito->id,
                'nome' => $inscrito->nome,
                'email' => $inscrito->email,
                'cpf' => $inscrito->cpf,
                'dt_cadastro' => date('d/m/Y H:i', strtotime($inscrito->dt_cadastro))
            ]);
        }

        //RETORNA OS DEPOIMENTOS
        return $resultItems;
    }

    /**
     * Método responsável por renderizar a view de home do painel
     *
     */
    public static function getInscrito(Request $request): string
    {

        #CONTEÚDO DA HOME DE DEPOIMENTOS
        $content = View::render('admin/inscritos/index', [
            'botaolink' => URL.'/admin/inscritos/new',
            'nomebotao' => 'Cadastrar novo inscrito',
            'descricao' => 'Lista de inscritos cadastrados no site',
            'itens' => self::getInscritoItems($request, $obPagination),
            'pagination' => parent::getPagination($request, $obPagination),
            'status' => self::getStatus($request)
        ]);

        #RETORNA A PÁGINA COMPLETA
        return parent::getPainel('Lista Inscritos', $content, 'inscritos');
    }

    /**
     * Método responsável por retornar o formulário de cadastro de um novo depoimento
     *
     */
    public static function getNewInscrito(Request $request): string
    {
        #CONTEÚDO DA HOME DE DEPOIMENTOS
        $content = View::render('admin/inscritos/form', [
            'titulo' => 'Novo Inscrito',
            'nome' => null,
            'mensagem' => null,
            'status' => self::getStatus($request),
            'script' => '<script src="' . $_ENV['URL'] . '/resources/assets/js/validate.js"></script>'
        ]);
        return parent::getPainel('Cadastro de novo inscrito', $content, 'Inscrito');
    }

    public static function setNewInscrito($request): string
    {
        //DADOS DO POST
        $postVars = $request->getPostVars();
        $obInscrito = new EntityIncritos;
        $obInscrito->nome = $postVars['nome'];
        $obInscrito->mensagem = $postVars['mensagem'];
        $obInscrito->data = date('Y-m-d H:i:s');

        $obInscrito->save();

        return $request->getRouter()->redirect('/admin/Inscrito/' . $obInscrito->id . '/edit?status=created');
    }


    /**
     * Método responsável por retornar o fomulário de edição de um depoimento
     *
     */
    public static function getEditInscrito(Request $request, int $id): string
    {
        $obInscrito = EntityIncritos::getById($id);

        if (!$obInscrito instanceof EntityIncritos) {
            $request->getRouter()->redirect('/admin/Inscrito');
        }

        #CONTEÚDO DA HOME DE DEPOIMENTOS
        $content = View::render('admin/Inscrito/form', [
            'titulo' => 'Cadastrar depoimento',
            'nome' => $obInscrito->nome,
            'mensagem' => $obInscrito->mensagem,
            'status' => self::getStatus($request),
            'script' => '<script src="' . $_ENV['URL'] . '/resources/assets/js/validate.js"></script>'
        ]);
        return parent::getPainel('Editar depoimento', $content, 'Inscrito');
    }

    public static function setEditInscrito(Request $request, int $id)
    {
        $obInscrito = EntityIncritos::getById($id);

        if (!$obInscrito instanceof EntityIncritos) {
            $request->getRouter()->redirect('/admin/Inscrito');
        }

        #POST VARS
        $postVars = $request->getPostVars();

        #ATUALIZA A INSTANCIA
        $obInscrito->nome = $postVars['nome'];
        $obInscrito->mensagem = $postVars['mensagem'];
        $obInscrito->update();

        return $request->getRouter()->redirect('/admin/inscritos/' . $obInscrito->id . '/edit?status=update');
    }

    /**
     * Método responsável por retornar o formulário de exclusão de um depoimento
     *
     */
    public static function getDeleteInscrito(Request $request, int $id): string
    {
        $obInscrito = EntityIncritos::getById($id);

        if (!$obInscrito instanceof EntityIncritos) {
            $request->getRouter()->redirect('/admin/inscritos');
        }

        #CONTEÚDO DA HOME DE DEPOIMENTOS
        $content = View::render('admin/inscritos/delete', [
            'title' => 'Excluir depoimento',
            'nome' => $obInscrito->nome,
            'mensagem' => $obInscrito->mensagem,
            'status' => self::getStatus($request)
        ]);
        return parent::getPainel('Excluir registro', $content, 'Inscrito');
    }

    /**
     * Método responsavel por excluir um depoimento
     * @return void
     */
    public static function setDeleteInscrito(Request $request, int $id)
    {
        $obInscrito = EntityIncritos::getById($id);

        if (!$obInscrito instanceof EntityIncritos) {
            $request->getRouter()->redirect('/admin/inscritos');
        }

        #EXCLUI O REGISTRO
        $obInscrito->delete();

        return $request->getRouter()->redirect('/admin/inscritos?status=deleted');
    }
}
