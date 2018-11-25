<?php

namespace ExcursionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('Excursion/Default/index.html.twig');
    }
}
