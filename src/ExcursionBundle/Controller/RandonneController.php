<?php

namespace ExcursionBundle\Controller;

use ExcursionBundle\Entity\Randonne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Randonne controller.
 *
 */
class RandonneController extends Controller
{
    /**
     * Lists all randonne entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $randonnes = $em->getRepository(Randonne::class)->findAll();

        return $this->render('@Excursion/randonne/index.html.twig', array(
            'randonnes' => $randonnes,
        ));
    }

    /**
     * Creates a new randonne entity.
     *
     */
    public function newAction(Request $request)
    {
        $randonne = new Randonne();
        $form = $this->createForm('ExcursionBundle\Form\RandonneType', $randonne);
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

    /**
     * Finds and displays a randonne entity.
     *
     */
    public function showAction(Randonne $randonne)
    {
        $deleteForm = $this->createDeleteForm($randonne);

        return $this->render('@Excursion/randonne/show.html.twig', array(
            'randonne' => $randonne,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing randonne entity.
     *
     */
    public function editAction(Request $request, Randonne $randonne)
    {
        $deleteForm = $this->createDeleteForm($randonne);
        $editForm = $this->createForm('ExcursionBundle\Form\RandonneType', $randonne);
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

    /**
     * Creates a form to delete a randonne entity.
     *
     * @param Randonne $randonne The randonne entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Randonne $randonne)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('randonne_delete', array('idrando' => $randonne->getIdrando())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
