<?php

namespace HotelBundle\Controller;

use HotelBundle\Entity\Chambre;
use HotelBundle\Entity\Hotel;
use HotelBundle\Form\ChambreType;
use HotelBundle\Form\HotelType;
use http\Exception\RuntimeException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ChambreController extends Controller
{
    public function readChambreAction(Request $request){
        //recuperer les donnéé à partir de bddd
        $chambre=$this->getDoctrine()->getRepository(Chambre::class)->findAll() ;
        //pagination
        $pagination  = $this->get('knp_paginator')->paginate(
            $chambre,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            6);

        //affichage de donnee
        return $this->render("@Hotel/Chambre/readChambre.html.twig",array("listChambre"=>$pagination));
    }
    public function createChambreAction(Request $request, $id)
    {
        /*
        $user  = $this->getUser();
        if($user->getRoles()[0] == 'ROLE_ADMIN')
        {

        }*/


        //1-form
        //1-a: objet vide
        $chambre=new Chambre();
        //1-b:create form
        $form=$this->createForm(ChambreType::class,$chambre);
        //2- les donneées
        $form=$form->handleRequest($request);
        if($form->isValid()){
            //3-cnx avec BD
            //die('id: '.$id);
            //$hotel = $this->getDoctrine()->getRepository();
            $hotel=$this->getDoctrine()->getManager()->getRepository(Hotel::class)->find($id);

            //die("hitel: ".$em->getNamehotel());

            if((int)$hotel->getNbreChambre() == null)
                $nbre = 1;
            else
                $nbre = (int)$hotel->getNbreChambre()+1;
            $hotel->setNbreChambre($nbre);

            $em = $this->getDoctrine()->getManager();
            $em->persist($chambre);
            $em->flush();


        }
        //1-c:envoi du form
        return $this->render('@Hotel/Chambre/createChambre.html.twig', array(
            'f'=>$form->createView()
        ));
    }



}
