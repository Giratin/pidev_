<?php

namespace ActivityBundle\Controller;

use ActivityBundle\Entity\ActivityType;
use ActivityBundle\Form\ActivityTypeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ActivityTypeController extends Controller
{
    public function readTypeAction()
    {
        $typeactivity = $this->getDoctrine()->getRepository(ActivityType::class)->findAll();

        return $this->render('@Activity/ActivityType/readt.html.twig', array(
            'typeactivity' => $typeactivity
        ));
    }
    public function createTypeAction(Request $request)
    {   //1-prepartion form
        //1.a:objet vide
        $typeactivity = new ActivityType();
        //1.b:create form
        $form = $this->createForm(ActivityTypeType::class, $typeactivity);
        //2-les donnees
        $form = $form->handleRequest($request);
        if ($form->isValid()) {
            //3-cnx avec BD
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeactivity);//ov va suvegarder dans ORM
            $em->flush();// on va suvegarder dans BD
            return $this->redirectToRoute('readType_activity');
        }
        return $this->render('@Activity/ActivityType/createt.html.twig', array(
            'form' => $form->createView()
        ));

    }
    public function updateTypeAction($idType, Request $request)
    {
        // 1-preparation from
        //1.a-on va recuperer les donnees de ORM
        $em = $this->getDoctrine()->getManager();
        $typeactivity = $em->getRepository(ActivityType::class)->find($idType);
        //1.b:create form
        $form = $this->createForm(ActivityTypeType::class, $typeactivity);
        //2
        $form = $form->handleRequest($request);
        //3
        if ($form->isValid()) {
            $em->flush();//
            return $this->redirectToRoute('readType_activity');
        }
        //1.c:on va envoyer notre from au view
        return $this->render('@Activity/ActivityType/updatet.html.twig', array(
            'form' => $form->createView()
        ));
        return $this->render('@Activity/ActivityType/readt.html.twig');
    }
    public function deleteTypeAction($idType)//on va supprimer l'objet de ORM apres de BD
    {
        $em = $this->getDoctrine()->getManager();
        $typeactivity = $em->getRepository(ActivityType::class)->find($idType);
        $em->remove($typeactivity);
        $em->flush();
        return $this->redirectToRoute('readType_activity');//redirecttoRoute:y3waed l'execution mil louwel RMV

    }




}
