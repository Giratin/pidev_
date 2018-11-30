<?php

namespace ExcursionBundle\Controller;

use ExcursionBundle\Entity\Imagesrando;
use ExcursionBundle\Entity\Randonne;
use ExcursionBundle\Entity\Reservationrandonne;
use ExcursionBundle\Form\RandonneType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;


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
        $user = $this->getUser();
        if($user == null || $user->getRoles()[0] == 'ROLE_USER')
        {
            $em = $this->getDoctrine()->getManager();

            $listRando = $this->getDoctrine()->getRepository(Randonne::class)->myFindByNewDate();
            $count = $this->getDoctrine()->getRepository(Randonne::class)->countNewExcursion();

            //$listRando = $this->getDoctrine()->getRepository(Randonne::class)->findAll();


            $randonne = $this->get('knp_paginator')->paginate(
                $listRando,
                $request->query->get('page',1),6
            );

            return $this->redirectToRoute('randonne_index', array(
                'randonnes' => $randonne,
                'count' => $count
                ));
        }

        else if($user->getRoles()[0] == 'ROLE_ADMIN')
        {
            $randonne = new Randonne();
            $form = $this->createForm(RandonneType::class, $randonne);
            $form->handleRequest($request);
            $new = $this->getDoctrine()->getRepository(Randonne::class)->countNewExcursion();
            $old = $this->getDoctrine()->getRepository(Randonne::class)->countOldExcursion();
            $sum = $this->getDoctrine()->getRepository(Randonne::class)->countAllExcursion();
            if ($form->isSubmitted() && $form->isValid()) {
                /**
                 * @var UploadedFile $file1
                 */
                $file1 = $randonne->getImgurl1();
                //encodage des images pour assurer l'unicité du nom de l'image sauvgardée
                $filename1 = md5(uniqid()).'.'.$file1->guessExtension();

                //transfert de l'image au dossier destination
                $file1->move($this->getParameter('image_directory'),$filename1);
                $randonne->setImgurl1($filename1);

                /**
                 * @var UploadedFile $file2
                 */
                $file2 = $randonne->getImgurl2();
                //encodage des images pour assurer l'unicité du nom de l'image sauvgardée
                $filename2 = md5(uniqid()).'.'.$file2->guessExtension();

                //transfert de l'image au dossier destination
                $file2->move($this->getParameter('image_directory'),$filename2);
                $randonne->setImgurl1($filename2);

                /**
                 * @var UploadedFile $file3
                 */
                $file3 = $randonne->getImgurl3();
                //encodage des images pour assurer l'unicité du nom de l'image sauvgardée
                $filename3 = md5(uniqid()).'.'.$file3->guessExtension();

                //transfert de l'image au dossier destination
                $file3->move($this->getParameter('image_directory'),$filename3);
                $randonne->setImgurl3($filename3);

                $em = $this->getDoctrine()->getManager();
                $em->persist($randonne);
                $em->flush();

                return $this->redirectToRoute('randonne_show', array('idrando' => $randonne->getIdrando()));
            }

            return $this->render('@Excursion/randonne/new.html.twig', array(
                'randonne' => $randonne,
                'form' => $form->createView(),
                'newcount' => $new,
                'oldcount' => $old,
                'sumcount' => $sum,
            ));
        }
        else
            return $this->render('@Excursion/randonne/index.html.twig');

    }

    public function showAction(Randonne $randonne)
    {
        $deleteForm = $this->createDeleteForm($randonne);
        $user = $this->getUser();
        $role = $user->getRoles()[0];
        $error = null;
        if($role == 'ROLE_ADMIN')
            $can = 'yes';
        else
            $can ='no';
        $idUser = $user->getId();
        $idRando = $randonne->getIdrando();
        $verify = $this->getDoctrine()
            ->getRepository(Reservationrandonne::class)
            ->myfindMe($idUser, $idRando);
        if($verify == null)
        {
            $error = null;
        }
        else
            $error =1;

        return $this->render('@Excursion/randonne/show.html.twig', array(
            'randonne' => $randonne,
            'delete_form' => $deleteForm->createView(),
            'role' => $can,
            'error' => $error,
        ));
    }

    public function editAction(Request $request, Randonne $randonne)
    {
        $deleteForm = $this->createDeleteForm($randonne);
        $editForm = $this->createForm(RandonneType::class, $randonne);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            /**
             * @var UploadedFile $file1
             */
            $file1 = $randonne->getImgurl1();
            //encodage des images pour assurer l'unicité du nom de l'image sauvgardée
            $filename1 = md5(uniqid()).'.'.$file1->guessExtension();

            //transfert de l'image au dossier destination
            $file1->move($this->getParameter('image_directory').$filename1);
            $randonne->setImgurl1($filename1);

            /**
             * @var UploadedFile $file2
             */
            $file2 = $randonne->getImgurl2();
            //encodage des images pour assurer l'unicité du nom de l'image sauvgardée
            $filename2 = md5(uniqid()).'.'.$file2->guessExtension();

            //transfert de l'image au dossier destination
            $file2->move($this->getParameter('image_directory').$filename2);
            $randonne->setImgurl1($filename2);


            /**
             * @var UploadedFile $file3
             */
            $file3 = $randonne->getImgurl3();
            //encodage des images pour assurer l'unicité du nom de l'image sauvgardée
            $filename3 = md5(uniqid()).'.'.$file3->guessExtension();

            //transfert de l'image au dossier destination
            $file3->move($this->getParameter('image_directory'),$filename3);
            $randonne->setImgurl3($filename3);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('randonne_edit', array('idrando' => $randonne->getIdrando()));
        }

        return $this->render('@Excursion/randonne/edit.html.twig', array(
            'randonne' => $randonne,
            'form' => $editForm->createView(),
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

    public function newadminAction(Request $request)
    {
        $user = $this->getUser();

        $listRando = $this->getDoctrine()->getRepository(Randonne::class)->myFindByNewDate();
        $count = $this->getDoctrine()->getRepository(Randonne::class)->countNewExcursion();

        $randonne = $this->get('knp_paginator')->paginate(
            $listRando,
            $request->query->get('page',1),10
        );

        if($user == null)
        {
            return $this->redirectToRoute('randonne_index', array(
                'randonnes' => $randonne,
                'count' => $count
            ));
        }
        else if($user->getRoles()[0] == 'ROLE_ADMIN')
        {
            //$randonne = new Randonne();
            $new = $this->getDoctrine()->getRepository(Randonne::class)->countNewExcursion();
            $old = $this->getDoctrine()->getRepository(Randonne::class)->countOldExcursion();
            $sum = $this->getDoctrine()->getRepository(Randonne::class)->countAllExcursion();

            return $this->render('@Excursion/randonne/newAdmin.html.twig', array(
                'randonne' => $randonne,
                'newcount' => $new,
                'oldcount' => $old,
                'sumcount' => $sum,
            ));
        }
        else
            return $this->render('@Excursion/randonne/index.html.twig');
    }

    public function reserveAction(Request $request, Randonne $randonne)
    {
        $user = $this->getUser();
        if($user != null)
        {
            if($user->getRoles()[0] == 'ROLE_USER')
            {
                $idUser = $user->getId();
                $idRando = $randonne->getIdrando();
                $verify = $this->getDoctrine()
                    ->getRepository(Reservationrandonne::class)
                    ->myfindMe($idUser, $idRando);

                if($verify == null)
                {
                    $reservation = new Reservationrandonne();
                    $reservation->setIdClient($idUser);
                    $reservation->setIdRandonne($idRando);
                    //die($idUser. ' ra: ' . $idRando);

                    $em = $this->getDoctrine()->getManager();
                    //updating place available in randonne table
                    $nbrClient = $em->getRepository(Randonne::class)->getAllAboutExcursion($idRando);


                    //verification of number of inscriptions vs capacity
                    if((int)$nbrClient[0]->getCapacite() > (int)$nbrClient[0]->getNbreclient() )
                    {
                        $new = (int)$nbrClient[0]->getNbreclient()+1;
                       //

                        $randonne->setNbreclient($new);
                        //die('nbre actuel: '.$nbrClient[0]->getNbreclient().' new one: '.$new );
                        //die('success');
                    }
                    else
                    {
                        $error = 2;
                    }
                    //Saving in new data DB

                    $em->persist($reservation);
                    $em->flush();
                    return $this->redirectToRoute('randonne_index');
                }

                else
                {
                    $error = 1;
                    return $this->redirectToRoute('randonne_index', array(
                        'error' => $error
                    ));
                }
            }
        }

    }

    public function myexcursionAction()
    {
        //$em = $this->getDoctrine()->

        $user = $this->getUser();
        if($user->getRoles()[0] == 'ROLE_USER')
        {
            $my = $this->getDoctrine()
                ->getRepository(Randonne::class)
                ->getAllMyExcursions($user->getId());

            $excursion = $this->getDoctrine()
                ->getRepository(Randonne::class)
                //->findBy($my);
                ->myFindExcursion($my);

            $old = array();
            $new = array();
            foreach($excursion as $n)
            {
                //if($n->getDaterando())
                //print_r($n->getDaterando());
                $date = $n->getDaterando();

                $Date = \DateTime::createFromFormat('Y-m-d', $date)->format('Y-m-d');
                $today = date("Y-m-d");



                if($Date > $today)
                {
                    $new[] = $n;
                    //print("mazelt");
                }
                else{
                    $old[] = $n;
                    //print ("sayé");
                }
            }
            //die(sizeof($my).' m');
            return $this->render('@Excursion/randonne/excursion.html.twig', array(
                'my' => $new,
                'old' => $old,
            ));
        }
        else if($user->getRoles()[0] == 'ROLE_ADMIN')
        {

        }
        else
        {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }
}
