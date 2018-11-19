<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $u = $this->getUser();
        if($u)
        {
            if( $u->getRoles()[0] == 'ROLE_USER')
            {
                return $this->render('@User/Default/index.html.twig' , array(
                    'user' => $u
                ));
            }
            elseif ($u->getRoles()[0] == 'ROLE_ADMIN')
            {
                return $this->render('@Admin/Default/index.html.twig' , array(
                    'user' => $u
                ));
            }
        }
        else
        {
            return $this->render('@User/Default/index.html.twig' , array(
                'user' => $u
            ));
        }
    }


    public function testAction()
    {
        $u = $this->getUser();

        return $this->render('@User/User/profile.html.twig', array(
            'user' => $u
        ));
    }
}
