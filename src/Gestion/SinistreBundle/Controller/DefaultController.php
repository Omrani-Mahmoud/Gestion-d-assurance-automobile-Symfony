<?php

namespace Gestion\SinistreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GestionSinistreBundle:Default:index.html.twig');
    }
}
