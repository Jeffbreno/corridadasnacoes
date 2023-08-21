<?php

namespace App\Controller\Pages;

use App\Utils\View;

class AlertController
{

    /**
     * Método responsável por retornar uma mensagem de sucesso
     *
     */
    public static function getSuccess($message): string
    {
        return View::render('pages/alerts/status', [
            'tipo' => 'success',
            'message' => $message
        ]);
    }

    /**
     * Método responsável por retornar uma mensagem de erro
     *
     */
    public static function getError($message): string
    {
        return View::render('pages/alerts/status', [
            'tipo' => 'danger',
            'message' => $message
        ]);
    }

    /**
     * Método responsável por retornar uma mensagem de erro
     *
     */
    public static function getWarning($message): string
    {
        return View::render('pages/alerts/status', [
            'tipo' => 'warning',
            'message' => $message
        ]);
    }
}
