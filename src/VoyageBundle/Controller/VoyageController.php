<?php

namespace VoyageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use VoyageBundle\Entity\Reservationvoyage;
use VoyageBundle\Entity\Voyage;
use VoyageBundle\Form\UpdateVoyageType;
use VoyageBundle\Form\VoyageType;

class VoyageController extends Controller
{
    public function readVoyageAction(Request $request)
    {
        //les donnée de bdd
        $voyages=$this->getDoctrine()->getRepository(Voyage::class)->findAll();
        //pagination
        $pagination  = $this->get('knp_paginator')->paginate(
            $voyages,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            3/*nbre d'éléments par page*/
        );

    //affichage
        return $this->render("@Voyage/Voyage/readVoyage.html.twig", array("list"=>$pagination));
    }

    public function createVoyageAction(Request $request)
    {
        $user=$this->getUser();
        if($user != null)
        {
            if($user->getRoles()[0]=="ROLE_ADMIN"){
                //1-form
                //1-a:objet vide
                $voyage=new Voyage();
                //1-b:create form
                $form=$this->createForm(VoyageType::class,$voyage);
                //2-les données
                $form=$form->handleRequest($request);
                $des=$voyage->getDestinationvoyage();
                $dep=$voyage->getDepartvoyage();
                $datedep=$voyage->getDatevoyagealler();
                $dateret=$voyage->getDatevoyageretour();
                $nmbre=$this->getDoctrine()->getRepository(Voyage::class)->countVoyage($des,$dep,$datedep,$dateret);
                $val=0;
                foreach ($nmbre as $data) {
                    $val=$data['nmbre'];

                }
                if($val == 0)
                    $valid =1;
                else
                    $valid =2;

                if($form->isSubmitted()&& ($val==0))
                {

                    //$valid =1;
                    //die('here');
                    /**
                     * @var UploadedFile $file
                     */
                    $file=$voyage->getImage();
                    $fileName=md5(uniqid()).'.'.$file->guessExtension();
                    $file->move($this->getParameter('image_directory'),$fileName);
                    $voyage->setImage($fileName);
                    //3-cnx avec BD
                    $em=$this->getDoctrine()->getManager();
                    $em->persist($voyage);
                    $em->flush();
                    return $this->redirectToRoute('voyage_read');
                }

                //1-c:envoi du form
                return $this->render('@Voyage/Voyage/createVoyage.html.twig', array(
                    "f"=>$form->createView(),
                    "valid"=> $valid,
                ));
            }
            else{
                return $this->redirectToRoute("fos_user_security_login");

            }
        }

    else{
            return $this->redirectToRoute("fos_user_security_login");

    }
    }
    public function deleteVoyageAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $voyage=$em->getRepository(Voyage::class)->find($id);
        $em->remove($voyage);
        $em->flush();
        return $this->redirectToRoute("voyage_read");
    }
    public function updateVoyageAction($id,Request $request)
    {
        //1-form
        //1.a
        $em=$this->getDoctrine()->getManager();
        $voyage=$em->getRepository(Voyage::class)->find($id);
        //1-b:create form
        $form=$this->createForm(UpdateVoyageType::class,$voyage);
        //2
        $form=$form->handleRequest($request);
        //3
        if($form->isValid()){
            //3-cnx avec BD
            $em=$this->getDoctrine()->getManager();
            $em->flush();
        }

        return $this->render('@Voyage/Voyage/updateVoyage.html.twig', array("f"=>$form->createView()

        ));
    }
    public function searchVoyageAction(Request $request){
        $user=$this->getUser();
        if($user != null)
        {
            if($user->getRoles()[0]!="ROLE_ADMIN"){
                $idc=$user->getId();
                $destination=$request->get('destinationvoyage');
                $depart=$request->get('departvoyage');
                $datedep=$request->get('datevoyagealler');
                $dateretour=$request->get('datevoyageretour');
                $nbplace=$request->get('nbPlaceDispo');
        //die('nbr'.$dateretour);
        if(isset($destination)&&isset($depart)&&isset($datedep)&&isset($dateretour)&&isset($nbplace)){
           // die("nb".$nbplace);
            $voyage=$this->getDoctrine()->getRepository(Voyage::class)->MyfindAllvoyage($destination,$depart,$datedep,$dateretour,$nbplace);
            $pagination  = $this->get('knp_paginator')->paginate(
                $voyage,
                $request->query->get('page', 1)/*le numéro de la page à afficher*/,
                3/*nbre d'éléments par page*/
            );
            return $this->render("@Voyage/Voyage/read_bookVoyage.html.twig", array("list"=>$pagination));
        }
        if(isset($_GET['book']))
        {
            $idVoyage = $request->get('idVoyage');
            $idc=$user->getId();
            $res=$this->getDoctrine()->getRepository(Reservationvoyage::class)-> countReservation($idc,$idVoyage);
            $val=0;
            foreach ($res as $data) {
                $val=$data['nmbre'];
            }
            //fait
            if($val==0){

            $nbrePlace = (int)$_GET['nbre'];
            //die("nb".$nbrePlace);
            $v= $this->getDoctrine()->getRepository(Voyage::class)->find($idVoyage);


                //die('v '.$v->getPrix());
            $prix = $v->getPrix();
            //die('prix'.$prix);
            $nbredispo = $v->getNbPlaceDispo();
            //die('nbre dispo'.$nbredispo);

            //die("vv: ".$idVoyage);

            $nom = $this->getUser()->getNom();
            $prenom = $this->getUser()->getPrenom();
            $email = $this->getUser()->getEmail();

            //$voy = $this->getDoctrine()->getRepository(Voyage::class)->voyageFind($idVoyage);

            //die('id: '.$voy[0]->getIdvoyage());
            $reservation = new Reservationvoyage();
            $reservation->setId($this->getUser()->getId());
            $reservation->setMail($email);
            //die(print_r($voy[0]));
            $reservation->setVoyage($v);
            $reservation->setNom($nom);
            $reservation->setPrenom($prenom);
          //  die('nb'.$nbrePlace);
            $reservation->setNbrePlaceReserv((int)$nbrePlace);
            //die($nbplace);
            $reservation->setPrix((int)$nbrePlace*(int)$prix);
            //die('prix = '.(int)$nbplace*(int)$prix);


            $v->setNbPlaceDispo((int)$nbredispo-(int)$nbrePlace);
            //die('nb= '.$v->getNbPlaceDispo());
            $v1 = $this->getDoctrine()->getManager();
            $v1->flush();

            //die($reservation->getMail()." Nom; ".$reservation->getNom()." nbre ".$reservation->getNbrePlaceReserv()." prix ".$reservation->getPrix());

            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();

            $id = $reservation->getIdreservation();

            //$res = $this->getDoctrine()->getRepository(Reservationvoyage::class)->find()

            return $this->redirectToRoute('reservation_read', array('id' => $id));

        } else{
                ?>
                <script>alert("Sorry , You've already booked for this flight !!");</script><?php
            }}
        return $this->render('@Voyage/Voyage/searchVoyage.html.twig');}
    else{
        return $this->redirectToRoute("fos_user_security_login");


        }
        }
        return $this->redirectToRoute("fos_user_security_login");
    }


    public function searchAjaxAction(Request $request){
    $user = $this->getUser();
    //if($user->getRoles()[0] == 'ROLE_ADMIN')
    //{
        $role = 1;
        if($request->isXmlHttpRequest()){
            $destination=$request->get('destination');
            $voyage=$this->getDoctrine()->getRepository(Voyage::class)->MyfindAllbydestination($destination);
            //initialisation of serializer
            $se=new Serializer(array(new ObjectNormalizer()));
            //normalizer les listes
            $data=$se->normalize($voyage);
            return new JsonResponse($data);
        }
        return $this->render('@Voyage/Voyage/searchAjaxVoyage.html.twig', array(
            'role' =>$role,
        ));}
    /*}
    else{
        $role = null;
        if($request->isXmlHttpRequest()){
            $destination=$request->get('destination');
            $voyage=$this->getDoctrine()->getRepository(Voyage::class)->MyfindAll($destination);
            //initialisation of serializer
            $se=new Serializer(array(new ObjectNormalizer()));
            //normalizer les listes
            $data=$se->normalize($voyage);
            return new JsonResponse($data);
        }
        return $this->render('@Voyage/Voyage/searchAjaxVoyage.html.twig', array(
            'role' =>$role,
        ));
    }*/
    public function searchAjaxbydepartAction(Request $request){
        $user = $this->getUser();
        //if($user->getRoles()[0] == 'ROLE_ADMIN')
        //{
        $role = 1;
        if($request->isXmlHttpRequest()){
            $depart=$request->get('depart');
            $voyage=$this->getDoctrine()->getRepository(Voyage::class)->MyfindAllbydepart($depart);
            //initialisation of serializer
            $se=new Serializer(array(new ObjectNormalizer()));
            //normalizer les listes
            $data=$se->normalize($voyage);
            return new JsonResponse($data);
        }
        return $this->render('@Voyage/Voyage/searchAjaxVoyage.html.twig', array(
            'role' =>$role,
        ));}


}
