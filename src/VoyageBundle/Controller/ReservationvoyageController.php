<?php

namespace VoyageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use VoyageBundle\Entity\Reservationvoyage;
use VoyageBundle\Form\ReservationvoyageType;


class ReservationvoyageController extends Controller
{

    public function ReserverVoyageAction(Request $request)
    {
        //1-form
        //1-a:objet vide
        $reservation=new Reservationvoyage();
        //1-b:create form
        $form=$this->createForm(ReservationvoyageType::class,$reservation);
        //2-les données
        $form=$form->handleRequest($request);
        if($form->isValid()){
            //3-cnx avec BD
            $em=$this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
        }
        //1-c:envoi du form
        return $this->render('@Voyage/ReservationVoyage/ReserverVoyage.html.twig', array(
            "f"=>$form->createView()
        ));
    }
}
