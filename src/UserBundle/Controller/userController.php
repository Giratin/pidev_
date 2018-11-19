<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class userController extends Controller
{

    public function testAction()
    {
        $this->render('@User/User/profile.html.twig');
    }
}
