<?php

namespace App\Controller\Admin;

use App\Http\Request;
use App\Utils\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PageController
{
    /**
     * Modulos disponíveis no painel
     */
    private static array $modules = [
        'home' => [
            'label' => 'Home',
            'link' => URL . '/admin',
            'data-feather' => 'sliders'

        ],
        'inscritos' => [
            'label' => 'Inscritos',
            'link' => URL . '/admin/inscritos',
            'data-feather' => 'book'

        ],
        'users' => [
            'label' => 'Usuários',
            'link' => URL . '/admin/users',
            'data-feather' => 'user'

        ],
        'categorias' => [
            'label' => 'Links de Incrição',
            'link' => URL . '/admin/categorias',
            'data-feather' => 'link'

        ]
    ];

    /**
     * Método responsável por retornar um link da paginação
     */
    private static function getLinks(mixed $page, mixed $url, $ultimaPagina = null): string
    {
        if ($ultimaPagina) {
            $queryParams['page'] = $ultimaPagina;
        } else {
            $queryParams['page'] = $page['page'];
        }

        #LINK
        if ($page['page'] == 0) {
            $link = $url . '?page=1';
        } else {
            $link = $url . '?' . http_build_query($queryParams);
        }


        #VIEW
        return View::render('admin/pagination/link', [
            'page' => $ultimaPagina ? 'Última' : ($page['page'] == 0 ? 'Primeira' : $page['page']),
            'link' => $link,
            'active' => ($page['current'] ? 'active' : '')
        ]);
    }

    /**
     * Método generico para páginação
     * 
     */
    public static function setPaginator(Request $request, Collection $items, int $perPage = 10)
    {
        $options = [];
        $options['path'] = $options['path'] ?? $request->getRouter()->getCurrentUrl();

        //GET DA PAGINA ATUAL 
        $queryParams = $request->getQueryParams();
        $currentPage = $queryParams['page'] ?? 1;

        $items = $items instanceof Collection ? $items : Collection::make($items);

        $paginator = new LengthAwarePaginator(
            $items->forPage($currentPage, $perPage),
            $items->count(),
            $perPage,
            $currentPage,
            $options
        );

        return $paginator->withPath($options['path']);
    }

     /**
     * Método responsavél por gerar links de paginação
     */
    public static function getPagination($request, $resultadosPaginados)
    {
        $currentPage = $resultadosPaginados->currentPage();
        $lastPage = $resultadosPaginados->lastPage();
        $url = $request->getRouter()->getCurrentUrl();
        $links = '';

        //LIMITE DA PAGINAÇÃO
        $limit = $_ENV['PAG_LIMIT'];

        //MEIO DA PAGINAÇÃO
        $middle = ceil($limit / 2);

        //INICIO DA PAGINAÇÃO
        $start = $middle > $currentPage ? 0 : $currentPage - $middle;

        //AJUTA O FINAL DA PAGINAÇÃO
        $limit = $limit + $start;

        if ($lastPage > 1) {

            //AJUSTA O LIMITE DA PAGINAÇÃO
            if ($limit > $lastPage) {
                $diff = $limit - $lastPage;
                $start -= $diff;
            }

            //LINK INICIAL
            if ($start > 0) {
                $page['page'] = 0;
                $page['current'] = 0;
                $links .= self::getLinks($page, $url);
            }

            // Links de páginas numeradas
            for ($i = 1; $i <= $lastPage; $i++) {
                $page['page'] = $i;
                $page['current'] = ($i === $currentPage ? 1 : 0);

                //VERIFICA O START DA PAGINAÇÃO
                if ($page['page'] <= $start) continue;

                //VERIFICA O LIMITE DA PAGINAÇÃO
                if ($page['page'] > $limit) {
                    $links .= self::getLinks($page, $url, $lastPage);
                    break;
                }

                $links .= self::getLinks($page, $url);

            }

            #REDERIZA BOX DOS LINKS
            return View::render('admin/pagination/box', [
                'links' => $links,
            ]);
        }
    }
    /**
     * Método responsável de retornar conteúdo (view) da estrutura genérica de página do painel
     *
     */
    public static function getPage(string $title, string $content): string
    {
        return View::render('admin/layout/page', [
            'title' => $title,
            'content' => $content
        ]);
    }

    /**
     * Método reponsável por renderizar a view do menu do painel
     */
    private static function getMenu($currentModule): string
    {
        #LINKS DO MENU
        $links = '';

        #ITERA OS MÓDULOS
        foreach (self::$modules as $hash => $module) {
            $links .= View::render('admin/menu/link', [
                'label' => $module['label'],
                'link' => $module['link'],
                'data-feather' => $module['data-feather'],
                'current' => $hash == $currentModule ? 'active' : ''
            ]);
        }

        #RETORNA A RENDERIZAÇÃO DO MENU
        return View::render('admin/menu/box', [
            'links' => $links
        ]);
    }

    /**
     * Método reponsável por redenrizar a view do painel com conteúdo dinâmico
     * 
     */
    public static function getPainel(string $title, string $content, string $currentModule): string
    {
        #RENDERIZA A VIEW DO PAINEL
        $contentPainel = View::render('admin/layout/painel', [
            'menu' => self::getMenu($currentModule),
            'content' => $content,
            'titulo' => $title
        ]);
        #RETORNA PÁGINA RENDERIZADA
        return self::getPage($title, $contentPainel);
    }
}
