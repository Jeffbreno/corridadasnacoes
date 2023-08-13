<?php

namespace App\Controller\Pages;

use App\Model\Entity\Organization;
use App\Utils\View;

class HomeController extends PageController
{
    public static function getHome()
    {
        $obOrganization = new Organization;
        $content = View::render('pages/home', []);

        return parent::getPage('Corrida das Nações', $content);
    }
}
