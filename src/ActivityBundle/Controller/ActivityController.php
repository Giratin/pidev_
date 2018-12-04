<?php

namespace ActivityBundle\Controller;

use ActivityBundle\Entity\Activity;
use ActivityBundle\Form\ActivityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ActivityController extends Controller
{
    public function readAction()
    {
        $user = $this->getUser();
        if($user != null )
        {
            if($user->getRoles()[0] == 'ROLE_ADMIN')
            {
                $activity=$this->getDoctrine()->getRepository(Activity::class)->findAll();
                return $this->render('@Activity/Activity/read.html.twig', array(
                    'activity'=>$activity
                ));
            }
            else
                return $this->redirectToRoute('user_homepage');
        }
        return $this->redirectToRoute('user_homepage');


    }
    public function createAction(Request $request)
    {
        $user = $this->getUser();
        if ($user !=null)
        {
            //1.préparation de l'objet vide
            $activity=new Activity();
            //2.préparation du form
            $form=$this->createForm(ActivityType::class,$activity);
            //3.sauvegarde dans la base des données
            $form=$form->handleRequest($request);
            if($form->isValid()){
                //4.cnx avec la base des données
                $em=$this->getDoctrine()->getManager();
                $activity->UploadActivityPicture();
                $em->persist($activity);
                $em->flush();
                return $this->redirectToRoute('read_activity');
            }
            return $this->render('@Activity/Activity/create.html.twig', array(
                'form'=>$form->createView()
            ));
        }
        else {
            return $this->redirectToRoute('activity_homepage');
        }


    }
    public function updateAction($idActivite,Request $request)
    {
        //1.cnx avec la base des données
        $em=$this->getDoctrine()->getManager();
            //2.charger l'objet à partir de la base des données
            $activity=$em->getRepository(Activity::class)->find($idActivite);
            //3.creation de la formulaire
            $form=$this->createForm(ActivityType::class,$activity);
            //4.ajout dans la base des données
            $form=$form->handleRequest($request);
            if ($form->isValid()){
                $em->flush();
                return$this->redirectToRoute('read_activity');
            }
            return $this->render('@Activity/Activity/update.html.twig',array(
                'form'=>$form->createView()
            ));


            return $this->render('@Activity/Activity/read.html.twig');


    }
    public function deleteAction($idActivite)
    {
        //1.cnx avec la base des données
        $em=$this->getDoctrine()->getManager();
        //2.ORM->Base des données
        $activity=$em->getRepository(Activity::class)->find($idActivite);
        //3.suppresision  à partir de la base des données
        $em->remove($activity);
        //4.push current output all the way to the browser with a few caveats.
        $em->flush();
        return $this->redirectToRoute('read_activity');

    }

    public function searchAction(Request $request)
    {
        $adresseactivite=$request->get('type');
        //test on if this entity exists or not
        if(isset($adresseactivite))
        {
            $activity=$this->getDoctrine()->getRepository(Activity::class)->myfindOneByAdresseactivite($adresseactivite);
            return $this->render('@Activity/Activity/read.html.twig', array('activity'=>$activity));
        }
        return $this->render('@Activity/Activity/search.html.twig');
    }

    public function listAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');

        $queryBuilder = $em->getRepository('ActivityBundle:Activity')->createQueryBuilder('bp');
        if($request->query->getAlnum('filter')){
            $queryBuilder
                ->where('bp.description LIKE :description')
                ->setParameter('description','%'.$request->query->getAlnum('filter').'%');
        }
        $query=$queryBuilder->getQuery();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );

        // parameters to template
        return $this->render('@Activity/Activity/list.html.twig', array('pagination' => $pagination));
    }


}
