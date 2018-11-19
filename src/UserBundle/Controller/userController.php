<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\ProfileType;

class userController extends Controller
{

    public function showAction()
    {
        $user = $this->getUser();
        return $this->render('@User/User/profile.html.twig', array(
            'user' => $user,
        ));
    }

    public function editAction(Request $request)
    {
        $user = $this->getUser();
        $edit = $this->createForm(ProfileType::class);
        $edit->handleRequest($request);

        if($edit->isSubmitted() && $edit->isValid())
        {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('user_profile');
        }

        return $this->render('@User/User/edit_profile.html.twig', array(
            'user' => $user,
            'edit' =>$edit->createView(),
        ));
    }
}
