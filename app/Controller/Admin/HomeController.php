<?php

namespace App\Controller\Admin;

use App\Http\Request;
use App\Utils\View;

class HomeController extends PageController
{

    /**
     * Método responsável por renderizar a view de home do painel
     *
     */
    public static function getHome(Request $request): string
    {
        #CONTEÚDO DA HOME
        $content = View::render('admin/home/index', []);

        #RETORNA A PÁGINA COMPLETA
        return parent::getPainel('Home', $content, 'home');
    }
}
