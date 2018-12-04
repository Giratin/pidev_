<?php

namespace VoyageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use VoyageBundle\Entity\Reservationvoyage;
use VoyageBundle\Entity\Voyage;
use VoyageBundle\Form\ReservationvoyageType;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;


class ReservationvoyageController extends Controller
{

    public function reserveReadAction(Request $request, $id)
{

    $em=$this->getDoctrine()->getManager();
    $voyage=$em->getRepository(Voyage::class)->find($id);

    //die("b : ".$id);


    //$idvoyage=$request->get('idVoyage');

    $iduser = $this->getUser()->getId();
   // die('id :'.$idvoyage . ' id user:'.$iduser);
    $reservation=$this->getDoctrine()->getRepository(Reservationvoyage::class)->find($id);

    //die( "id: ".($reservation));
    //affichage
    return $this->render("@Voyage/Voyage/readreservation.html.twig", array("list"=>$reservation));

}

    public function reserveReadByUserAction(Request $request)
    {
    $user=$this->getUser();
    if($user != null)
    {
        if($user->getRoles()[0]!="ROLE_ADMIN") {
            $idc=$user->getId();
            $reservation=$this->getDoctrine()->getRepository(Reservationvoyage::class)->findByUser($idc);

            $pagination  = $this->get('knp_paginator')->paginate(
                $reservation,
                $request->query->get('page', 1)/*le numéro de la page à afficher*/,
                1/*nbre d'éléments par page*/
            );

            return $this->render("@Voyage/Voyage/readMyReservation.html.twig", array("list"=>$pagination));
        }
            else
            {return $this->redirectToRoute("fos_user_security_login");}
        }
    return $this->redirectToRoute("fos_user_security_login");
        }

        public function cancelreservationAction($id){

            $user=$this->getUser();
            if($user != null)
            {
                if($user->getRoles()[0]!="ROLE_ADMIN") {
            $em=$this->getDoctrine()->getManager();
            $reserv=$em->getRepository(Reservationvoyage::class)->find($id);


            $nbreserv=$reserv->getNbrePlaceReserv();
            //die('nb'.$nbreserv);
            $idv=$reserv->getVoyage()->getIdvoyage();
            //die('id'.$idv);
            $voy=$this->getDoctrine()->getManager();
            $voyage=$voy->getRepository(Voyage::class)->find($idv);
            $nb=$voyage->getNbPlaceDispo();
            $voyage->setNbPlaceDispo((int)$nb+(int)$nbreserv);
            $voy=$this->getDoctrine()->getManager();
            $voy->flush();
            $em->remove($reserv);
            $em->flush();

            return $this->redirectToRoute("reservation_read_User");
        }}

            return $this->redirectToRoute("fos_user_security_login");
    }





    public function pdfAction()
    {
       $user = $this->getUser();
        if ($user != null) {

            $reservation = $this->getDoctrine()->getRepository(Reservationvoyage::class)->findAll();
        }
        foreach ($reservation as $ab) {
            $id = $ab->getIdreservation();
        }

        $html = $this->renderView('@Voyage/Voyage/pdf.html.twig', array(
           "list" => $reservation,
          "id" => $id
            //..Send some data to your view if you need to //
        ));

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            'Reservation-'.$id .'.pdf'
        );
    }
}
