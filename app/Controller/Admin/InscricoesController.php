<?php

namespace App\Controller\Admin;

use App\Http\Request;
use App\Utils\View;
use App\Model\Entity\Inscricao as EntityIncritos;
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
                'status' => $inscrito->status_pag,
                'dt_cadastro' => date('d/m/Y H:i', strtotime($inscrito->dt_cadastro))
            ]);
        }

        //RETORNA OS DEPOIMENTOS
        return $resultItems;
    }

    public static function getModal($id): string
    {
        $obInscrito = EntityIncritos::find($id);
        $obCategoria = EntityCategoria::find($obInscrito->categoria);
        $obInscrito->categoria = $obCategoria->titulo;

        if ($obInscrito->genero == 'M') {
            $obInscrito->genero = 'MASCULINO';
        } else {
            $obInscrito->genero = 'FEMININO';
        }

        if ($obInscrito->status_pag == 'P') {
            $obInscrito->status_pag = 'PAGA';
        } else {
            $obInscrito->status_pag = 'ABERTA';
        }

        $obInscrito->dt_nascimento = date('d/m/Y', strtotime($obInscrito->dt_nascimento));
        $obInscrito->dt_cadastro = date('d/m/Y H:i', strtotime($obInscrito->dt_cadastro));

        return $obInscrito;
    }

    /**
     * Método responsável por renderizar a view de home do painel
     *
     */
    public static function getInscrito(Request $request): string
    {

        #CONTEÚDO DA HOME DE DEPOIMENTOS
        $content = View::render('admin/inscritos/index', [
            'botaolink' => URL . '/admin/inscritos/new',
            'nomebotao' => 'Cadastrar novo inscrito',
            'descricao' => 'Lista de inscritos cadastrados no site',
            'itens' => self::getInscritoItems($request, $obPagination),
            'pagination' => parent::getPagination($request, $obPagination),
            'status' => self::getStatus($request),
            'modal' => View::render('admin/inscritos/modal')
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
            'nome' => null,
            'nome_responsavel' => null,
            'email' => null,
            'genero' => '<option value="M">Masculino</option>
            <option value="F">Feminino</option>
            <option value="O">Não informar</option>',
            'cpf' => null,
            'categoria' => null,
            'dt_nascimento' => null,
            'celular' => null,
            'logradouro' => null,
            'numero' => null,
            'complemento' => null,
            'bairro' => null,
            'cidade' => null,
            'uf' => null,
            'distancia' => null,
            'camisa' =>
            '<option value="PP">PP (63cm X 43cm)</option>
            <option value="P">P (65cm X 46cm)</option>
            <option value="M">M (67cm X 50cm)</option>
            <option value="G">G (69cm X 54cm)</option>
            <option value="GG">GG (71cm X 57cm)</option>
            <option value="XGG">XGG (75cm X 60cm)</option>',
            'equipe' => null,
            'status_pag' => null,
            'status' => self::getStatus($request)
        ]);
        return parent::getPainel('Cadastrar Novo Inscrito', $content, 'inscritos');
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

        return $request->getRouter()->redirect('/admin/inscritos/' . $obInscrito->id . '/edit?status=created');
    }


    /**
     * Método responsável por retornar o fomulário de edição de um depoimento
     *
     */
    public static function getEditInscrito(Request $request, int $id): string
    {
        $obInscrito = EntityIncritos::join(
            'categorias',
            'categorias.id',
            '=',
            'usuarios_inscritos.categoria'
        )->where('usuarios_inscritos.id', $id)
            ->select(['categorias.titulo', 'usuarios_inscritos.*'])
            ->first();

        if (!$obInscrito instanceof EntityIncritos) {
            $request->getRouter()->redirect('/admin/inscritos');
        }

        $genero = '
        <option ' . ($obInscrito->genero === "M" ? "selected" : "") . ' value="M">Masculino</option>
        <option ' . ($obInscrito->genero === "F" ? "selected" : "") . ' value="F">Feminino</option>
        <option ' . ($obInscrito->genero === "O" ? "selected" : "") . ' value="O">Não informar</option>
        ';

        $camisa = '
            <option ' . ($obInscrito->canisa === "PP" ? "selected" : "") . ' value="PP">PP (63cm X 43cm)</option>
            <option ' . ($obInscrito->canisa === "P" ? "selected" : "") . ' value="P">P (65cm X 46cm)</option>
            <option ' . ($obInscrito->canisa === "M" ? "selected" : "") . ' value="M">M (67cm X 50cm)</option>
            <option ' . ($obInscrito->canisa === "G" ? "selected" : "") . ' value="G">G (69cm X 54cm)</option>
            <option ' . ($obInscrito->canisa === "GG" ? "selected" : "") . ' value="GG">GG (71cm X 57cm)</option>
            <option ' . ($obInscrito->canisa === "XGG" ? "selected" : "") . ' value="XGG">XGG (75cm X 60cm)</option>
        ';

        $queryCategorias = EntityCategoria::orderBy('titulo', 'asc')->get();
        $categoria = '';
        foreach ($queryCategorias as $categorias) {
            $categoria .= '<option ' . ($obInscrito->categoria === $categorias->id ? "selected" : "") . ' value="' . $categorias->id . '">' . $categorias->titulo . '</option>';
        }

        #CONTEÚDO DA HOME DE DEPOIMENTOS
        $content = View::render('admin/inscritos/form', [
            'nome' => $obInscrito->nome,
            'nome_responsavel' => $obInscrito->nome_responsavel,
            'email' => $obInscrito->email,
            'genero' => $genero,
            'cpf' => $obInscrito->cpf,
            'categoria' => $categoria,
            'dt_nascimento' => null,
            'celular' => null,
            'logradouro' => null,
            'numero' => null,
            'complemento' => null,
            'bairro' => null,
            'cidade' => null,
            'uf' => null,
            'distancia' => null,
            'camisa' => $camisa,
            'equipe' => null,
            'status_pag' => null,
            'status' => self::getStatus($request)
        ]);
        return parent::getPainel('Editar inscrição', $content, 'inscritos');
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
        return parent::getPainel('Excluir registro', $content, 'inscritos');
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
