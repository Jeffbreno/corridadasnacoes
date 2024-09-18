<?php

namespace App\Controller\Pages;

use App\Utils\View;

class HomeController extends PageController
{

    /**
     * SECTION DE PROPAGANDA
     */
    private static function getPropaganda()
    {
        return View::render('pages/propaganda');
    }
    /**
     * SECTION DE CAMISAS
     */
    private static function getCamisas()
    {
        return View::render('pages/camisas');
    }

    /**
     * SECTION MAIOR MELHOR
     */
    private static function getMaiorMelhor()
    {
        return View::render('pages/maior_melhor');
    }

    /**
     * SECTION DA GALERIA DE FOTOS
     */
    private static function getGaleria()
    {
        return View::render('pages/galeria');
    }

    /**
     * SECTION DO OBJETIVO
     */
    private static function getObjetivo()
    {
        return View::render('pages/objetivo');
    }

    /**
     * SECTION DA INCRIÇÃO
     */
    private static function getIncricao()
    {
        return View::render('pages/inscricao');
    }

    /**
     * SECTION SOBRE O EVENTO
     */
    private static function getEvento()
    {
        return View::render('pages/evento');
    }

    /**
     * MAPA DO PECURSO
     */
    private static function getPercurso()
    {
        return View::render('pages/percurso');
    }

    /**
     * PATROCINADORES
     */
    private static function getPatrocinadores()
    {
        return View::render('pages/patrocinadores');
    }

    /**
     * RENDERIZA TODOS OS SECTIONS NA TELA HOME
     */
    public static function getHome()
    {
        $content = View::render('pages/home', [
            'propaganda' => self::getPropaganda(),
            'camisas' => self::getCamisas(),
            'maiorMelhor' => self::getMaiorMelhor(),
            'galeria' => self::getGaleria(),
            'objetivo' => self::getObjetivo(),
            'inscricao' => self::getIncricao(),
            'evento' => self::getEvento(),
            'percurso' => self::getPercurso(),
            'patrocinadores' => self::getPatrocinadores(),

        ]);

        return parent::getPage('Corrida das Nações', $content);
    }
}
