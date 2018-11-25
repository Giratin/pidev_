<?php

namespace ExcursionBundle\Controller;

use ExcursionBundle\Entity\Imagesrando;
use ExcursionBundle\Entity\Randonne;
use ExcursionBundle\Form\RandonneType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class RandonneController extends Controller
{

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $listRando = $this->getDoctrine()->getRepository(Randonne::class)->myFindByNewDate();
        $count = $this->getDoctrine()->getRepository(Randonne::class)->countNewExcursion();

        //$listRando = $this->getDoctrine()->getRepository(Randonne::class)->findAll();


        $randonne = $this->get('knp_paginator')->paginate(
            $listRando,
            $request->query->get('page',1),6
        );
        return $this->render('@Excursion/randonne/index.html.twig', array(
            'randonnes' => $randonne,
            'count' => $count,
        ));

    }


    public function newAction(Request $request)
    {
       $randonne = new Randonne();
        $form = $this->createForm(RandonneType::class, $randonne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($randonne);
            $em->flush();


            return $this->redirectToRoute('randonne_show', array('idrando' => $randonne->getIdrando()));
        }

        return $this->render('@Excursion/randonne/new.html.twig', array(
            'randonne' => $randonne,
            'form' => $form->createView(),
        ));


    }

    public function showAction(Randonne $randonne)
    {
        $deleteForm = $this->createDeleteForm($randonne);

        return $this->render('@Excursion/randonne/show.html.twig', array(
            'randonne' => $randonne,
            'delete_form' => $deleteForm->createView()
        ));
    }


    public function editAction(Request $request, Randonne $randonne)
    {
        $deleteForm = $this->createDeleteForm($randonne);
        $editForm = $this->createForm(RandonneType::class, $randonne);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('randonne_edit', array('idrando' => $randonne->getIdrando()));
        }

        return $this->render('@Excursion/randonne/edit.html.twig', array(
            'randonne' => $randonne,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a randonne entity.
     *
     */
    public function deleteAction(Request $request, Randonne $randonne)
    {
        $form = $this->createDeleteForm($randonne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($randonne);
            $em->flush();
        }

        return $this->redirectToRoute('randonne_index');
    }


    private function createDeleteForm(Randonne $randonne)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('randonne_delete', array('idrando' => $randonne->getIdrando())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }



    public function oldAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $listRando = $this->getDoctrine()->getRepository(Randonne::class)->myfindByOldDate();
        $count = $this->getDoctrine()->getRepository(Randonne::class)->countOldExcursion();
        $randonne = $this->get('knp_paginator')->paginate(
            $listRando,
            $request->query->get('page',1),6
        );
        return $this->render('@Excursion/randonne/old.html.twig', array(
            'randonnes' => $randonne,
            'num' => $count,
        ));

    }
}
