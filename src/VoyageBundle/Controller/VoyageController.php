<?php

namespace VoyageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use VoyageBundle\Entity\Voyage;
use VoyageBundle\Form\UpdateVoyageType;
use VoyageBundle\Form\VoyageType;

class VoyageController extends Controller
{ public function readVoyageAction(Request $request){
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
        //1-form
        //1-a:objet vide
        $voyage=new Voyage();
        //1-b:create form
        $form=$this->createForm(VoyageType::class,$voyage);
        //2-les données
        $form=$form->handleRequest($request);
        if($form->isValid()){
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
        }
        //1-c:envoi du form
        return $this->render('@Voyage/Voyage/createVoyage.html.twig', array(
            "f"=>$form->createView()
        ));
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
        $destination=$request->get('destinationvoyage');
        if(isset($destination)){
            $voyage=$this->getDoctrine()->getRepository(Voyage::class)->MyfindAll($destination);
            $pagination  = $this->get('knp_paginator')->paginate(
                $voyage,
                $request->query->get('page', 1)/*le numéro de la page à afficher*/,
                3/*nbre d'éléments par page*/
            );
            return $this->render("@Voyage/Voyage/readVoyage.html.twig", array("list"=>$pagination));
        }
        return $this->render('@Voyage/Voyage/searchVoyage.html.twig');
    }

    public function searchAjaxAction(Request $request){
        if($request->isXmlHttpRequest()){
            $destination=$request->get('destination');
            $voyage=$this->getDoctrine()->getRepository(Voyage::class)->MyfindAll($destination);
            //initialisation of serializer
            $se=new Serializer(array(new ObjectNormalizer()));
            //normalizer les listes
            $data=$se->normalize($voyage);
            return new JsonResponse($data);
        }
        return $this->render('@Voyage/Voyage/searchAjaxVoyage.html.twig');
    }

}
