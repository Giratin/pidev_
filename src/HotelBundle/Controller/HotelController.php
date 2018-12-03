<?php

namespace HotelBundle\Controller;

use DoctrineTest\InstantiatorTestAsset\SerializableArrayObjectAsset;
use HotelBundle\Entity\Hotel;
use HotelBundle\Entity\ReservationHotel;
use HotelBundle\Form\HotelType;
use HotelBundle\Form\HotelUpdateType;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class HotelController extends Controller
{
public function readHotelAction(\Symfony\Component\HttpFoundation\Request $request){
    $user = $this->getUser();
    if($user != null)
    {
        if($user->getRoles()[0] == "ROLE_ADMIN")
            $connected = "admin";
        else if($user->getRoles()[0] == "ROLE_USER")
        {
            $connected = "user";

            if(isset($_GET['reserve']))
            {
                $idhot = $request->get('hotel');
                $single = $request->get('single');
                $double = $request->get('double');

                //die("Hotel ".$hotel." single: ".$single." double: ".$double);

                $reserv = new ReservationHotel();
                $reserv->setIdclient($user->getId());

                //$hot->setIdhotel($hotel);

                $hot = $this->getDoctrine()->getManager()->getRepository(Hotel::class)->find($idhot);
                $hotel = new Hotel();
                //die('hotel: '.$hot[0]->getIdHotel());
                $reserv->setIdhotel($hot);
                $reserv->setNbreDouble($double);
                $reserv->setNbreIndiv($single);

               //modification prix et nbre dispo
                $prixindiv=$hot->getPrixIndiv();
                $prixdoube=$hot->getPrixDouble();
                $reserv->setPrix((int)$prixdoube*(int)$double+(int)$prixindiv*(int)$single);
                $hot->setNbreDeChambreDespo((int)$hot->getNbreDeChambreDespo()-(int)$double-(int)$single);


                $em=$this->getDoctrine()->getManager();
                $em->flush();


                //die("Hotel ".$hot->getIdhotel());

                $em = $this->getDoctrine()->getManager();
                $em->persist($reserv);
                $em->flush();
            }



            //die("Reservation success");

        }
    }
    else
        $connected = "neither";
            //recuperer les donnéé à partir de bddd
        $hotel=$this->getDoctrine()->getRepository(Hotel::class)->findAll() ;
        //pagination
        $pagination  = $this->get('knp_paginator')->paginate(
            $hotel,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            2/*nbre d'éléments par page*/
        );
        //affichage de donnee
        return $this->render("@Hotel/Hotel/readHotel.html.twig",array(
            "listHotel"=>$pagination,
            "user" => $connected
        ));

    }
public function createHotelAction(\Symfony\Component\HttpFoundation\Request $request){
    $user = $this->getUser();
    if($user->getRoles()[0] == "ROLE_ADMIN")
    {
        //1-form


        //1-a: objet vide
        $hotel=new Hotel();
        //1-b:create form
        $form=$this->createForm(HotelType::class,$hotel);
        //2- les donneées
        $form=$form->handleRequest($request);
        $nom=$hotel->getNamehotel();
        $adress=$hotel->getAdressehotel();
        $nbre = $this->getDoctrine()->getRepository(Hotel::class)->countHotel($nom,$adress);
        $act = 0;
        foreach($nbre as $data)
            $act = $data['nmbre'];
       /* die(
            "act: ".$act
        );*/
        if(($form->isValid())&&($act==0)){
            /**
             * @var UploadedFile $file
             */
            $file=$hotel->getImghotel();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'),$fileName);
            //3-cnx avec BD
            $hotel->setImghotel($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($hotel);
            $em->flush();
        }
        //1-c:envoi du form
        return $this->render('@Hotel/Hotel/createHotel.html.twig', array(
           'f'=>$form->createView()
       ));

    }
    else{
        $connected = "neither";
        //recuperer les donnéé à partir de bddd
        $hotel=$this->getDoctrine()->getRepository(Hotel::class)->findAll() ;
        //pagination
        $pagination  = $this->get('knp_paginator')->paginate(
            $hotel,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            2/*nbre d'éléments par page*/
        );
        //affichage de donnee
        return $this->render("@Hotel/Hotel/readHotel.html.twig",array(
            "listHotel"=>$pagination,
            "user" => $connected
        ));
    }

}
    public function deleteHotelAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $hotel=$em->getRepository(Hotel::class)->find($id);
        $em->remove($hotel);
        $em->flush();
        return $this->redirectToRoute('hotel_read');

    }
    public function updateHotelAction($id,\Symfony\Component\HttpFoundation\Request $request)
    {
        //1-form
        //1.
        $em=$this->getDoctrine()->getManager();
        $hotel=$em->getRepository(Hotel::class) ->find($id);
        $form=$this->createForm(HotelUpdateType::class,$hotel);
//2
        $form=$form->handleRequest($request);
        //3
        if($form->isValid()){

            $em->flush();
        }
        return $this->render('@Hotel/Hotel/updateHotel.html.twig', array(  'f'=>$form->createView()
            // ...
        ));
    }
    public function searchHotelAction(\Symfony\Component\HttpFoundation\Request $request){
        $adresse=$request->get('adressehotel');
        if(isset($adresse)){
            $hotels=$this->getDoctrine()->getRepository(Hotel::class)->myfindall($adresse);
            $pagination  = $this->get('knp_paginator')->paginate(
                $hotels,
                $request->query->get('page', 1)/*le numéro de la page à afficher*/,
                2);/*nbre d'éléments par page*/
            return $this->render("@Hotel/Hotel/readHotel.html.twig",array("listHotel"=>$pagination));
        }
        return $this->render('@Hotel/Hotel/searchHotel.html.twig');

    }
    public function searchHotelAjaxAction(\Symfony\Component\HttpFoundation\Request $request){

    if($request->isXmlHttpRequest())
    {
            $name=$request->get('name');
            $hotels=$this->getDoctrine()->getRepository(Hotel::class)->myfindallbyname($name);
            $se=new Serializer(array(new ObjectNormalizer()));
            $data=$se->normalize($hotels);
            return new JsonResponse($data);
    }
        return $this->render('@Hotel/Hotel/searchHotelAjax.html.twig');

    }

    public function reserveAction(\Symfony\Component\HttpFoundation\Request $request, Hotel $hotel)
    {
        $user = $this->getUser();
        if($user != null)
        {
            if($user->getRoles()[0] == 'ROLE_USER')
            {
                $idUser = $user->getId();
                $idHotel = $hotel->getIdhotel();

                $reservation = new ReservationHotel();
                $reservation->setHotel($idHotel);
                $reservation->setIdclient($idUser);
                //$nbS = $request->

                die("Hotel : ".$idHotel. " User ".$idUser);
                //$reservation->set
            }
        }
    }
}
