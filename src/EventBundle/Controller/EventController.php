<?php

namespace EventBundle\Controller;

use EventBundle\Entity\Event;
use EventBundle\Entity\Reservationevent;
use EventBundle\Form\EventaddType;
use EventBundle\Form\EventupType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;


class EventController extends Controller
{
    public function readEventAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        //$dql = "SELECT bp FROM EventBundle:Event bp";
        $queryBuilder = $em->getRepository('EventBundle:Event')->createQueryBuilder('bp');

        //$event=$em->getRepository(Event::class)->findAll();
        if($request->query->getAlnum('filter')){
            $queryBuilder
                ->where('bp.nomevent LIKE :nomevent')
                ->setParameter('nomevent','%'.$request->query->getAlnum('filter').'%');
        }
        $query=$queryBuilder->getQuery();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result=$paginator->paginate(
            $query,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',1)
        );
        return $this->render('@Event/EventViews/readEvent.html.twig', array(
            'events'=>$result,
        ));
    }
    public function listEventAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        //$dql = "SELECT bp FROM EventBundle:Event bp";
        $queryBuilder = $em->getRepository('EventBundle:Event')->createQueryBuilder('bp');

        //$event=$em->getRepository(Event::class)->findAll();
        if($request->query->getAlnum('filter')){
            $queryBuilder
                ->where('bp.nomevent LIKE :nomevent')
                ->setParameter('nomevent','%'.$request->query->getAlnum('filter').'%');
        }
        $query=$queryBuilder->getQuery();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result=$paginator->paginate(
            $query,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',1)
        );
        return $this->render('@Event/EventViews/listEvent.html.twig', array(
            'events'=>$result,
        ));
    }

    public function createEventAction(Request $request)
    {

        $user = $this->getUser();
        if($user != null)
        {
            if($user->getRoles()[0] == 'ROLE_ADMIN')
            {
                //1-Form
                //1-a-objet vide
                $event=new Event();
                //1-b-create form
                $form=$this->createForm(EventaddType::class,$event);
                //2-donnees
                $form=$form->handleRequest($request);
                if($form->isValid()){
                    /**
                     * @var UploadedFile $file
                     */
                    $file=$event->getEventImg();
                    $fileName=md5(uniqid()).'.'.$file->guessExtension();
                    $file->move($this->getParameter('image_directory'),$fileName);
                    //3-cnx avec bd
                    $event->setEventImg($fileName);
                    $em=$this->getDoctrine()->getManager();
                    $em->persist($event);
                    $em->flush();
                }
                //1-c-Envoi du form
                return $this->render('@Event/EventViews/createEvent.html.twig', array(
                    'f'=>$form->createView()
                ));
            }
            else
            {
                return $this->redirectToRoute('user_homepage');
            }
        }
        return $this->redirectToRoute('user_homepage');
    }

    public function updateEventAction($idEvent, Request $request)
    {
        $user = $this->getUser();
        if($user != null)
        {
            if($user->getRoles()[0] == 'ROLE_ADMIN')
            {
                //1-form
                //1-a-
                $em=$this->getDoctrine()->getManager();
                $events=$em->getRepository(Event::class)->findOneByIdevent($idEvent);
                //1-b
                $form=$this->createForm(EventupType::class,$events);
                //2
                $form=$form->handleRequest($request);
                if ($form->isValid()){

                    $em->flush();
                }
                //1-c
                return $this->render('@Event/EventViews/updateEvent.html.twig', array(
                    'form'=>$form->createView()
                ));
            }
            else
            {
                return $this->redirectToRoute('user_homepage');
            }
        }
        else
        {
            return $this->redirectToRoute('user_homepage');
        }
    }


    public function deleteEventAction($idEvent)
    {
        $user = $this->getUser();
        if($user != null)
        {
            if($user->getRoles()[0] == 'ROLE_ADMIN')
            {
                $em=$this->getDoctrine()->getManager();
                $event=$em->getRepository(Event::class)->findOneByIdevent($idEvent);
                $em->remove($event);
                $em->flush();
                return $this->redirectToRoute('read_event');
            }
            else
            {
                return $this->redirectToRoute('user_homepage');
            }
        }
        else
        {
            return $this->redirectToRoute('user_homepage');
        }
    }


    public function searchAjaxAction(Request $request){
        if($request->isXmlHttpRequest()){
            $name=$request->get('nomEvent');
            $event=$this->getDoctrine()->getRepository(Event::class)->find($name);
            //initialisation of serializer
            $se=new Serializer(array(new ObjectNormalizer()));
            //normalizer les listes
            $data=$se->normalize($event);
            return new JsonResponse($data);
        }
        return $this->render('@Event/EventViews/searchAjax.html.twig');
    }


    public function getEventAction($idEvent){
        $em = $this->getDoctrine()->getManager();
        $event=$em->getRepository(Event::class)->findOneByIdevent($idEvent);

        $user = $this->getUser();
        if($user != null)
        {
            if($user->getRoles()[0] == 'ROLE_USER')
            {
                $idUser = $user->getId();
                //$idEvent = $event->getIdevent();
                //die('id event'.$idEvent);
                $verify = $this->getDoctrine()
                    ->getRepository(Reservationevent::class)
                    ->myfindMe($idUser, $idEvent);

                if($verify == null)
                {
                    $error = 1;
                }

                else
                {
                    $error = 2;
                }
                return $this->render('@Event/EventViews/getEvent.html.twig', array(
                    'events'=>$event,
                    'error' => $error
                ));
            }

            else
                return $this->redirectToRoute('admin_homepage');
        }
        return $this->redirectToRoute('fos_user_security_login');


    }
    public function participateEventAction(Request $request,$idEvent )
    {
        $user = $this->getUser();

        if($user != null)
        {
            if($user->getRoles()[0] == 'ROLE_USER')
            {
                $idUser = $user->getId();
                //$idEvent = $event->getIdevent();
                //die('id event'.$idEvent);
                $verify = $this->getDoctrine()
                    ->getRepository(Reservationevent::class)
                    ->myfindMe($idUser, $idEvent);

                if($verify == null)
                {
                    $error = 1;
                    $reservation = new Reservationevent();
                    $reservation->setIdclient($idUser);
                    $reservation->setIdevent($idEvent);
                    //die($idUser. ' ra: ' . $idRando);
                    $em = $this->getDoctrine()->getManager();
                    //updating place available in randonne table
                    $nbrePersonnes = $em->getRepository(Event::class)->findOneByIdevent($idEvent);

                    $nbre = $nbrePersonnes->getNbrepersonnes();
                    if($nbre == null)
                    {
                        $nbre = 0;
                    }
                    //die('nn: '.$nbrePersonnes->getCapevent().' nbtr: '.$nbre);

                    //verification of number of inscriptions vs capacity
                    if(((int)$nbrePersonnes->getCapevent()) > (int)$nbre )
                    {
                        $new = (int)$nbre+1;
                        //
                        $nbrePersonnes->setNbrepersonnes($new);
                        //$event->setNbrepersonnes($new);
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
                    return $this->redirectToRoute('list_event');
                }

                else
                {
                    $error = 2;
                    return $this->redirectToRoute('list_event', array(
                        'error' => $error
                    ));
                }
            }
            else
                return $this->redirectToRoute('admin_homepage');
        }
        return $this->redirectToRoute('fos_user_security_login');
    }

    public function readEventAdminAction(Request $request)
    {
        $user = $this->getUser();
        if($user != null)
        {
            if($user->getRoles()[0] == 'ROLE_ADMIN')
            {
                $em = $this->getDoctrine()->getManager();

                //$dql = "SELECT bp FROM EventBundle:Event bp";
                $queryBuilder = $em->getRepository('EventBundle:Event')->createQueryBuilder('bp');

                //$event=$em->getRepository(Event::class)->findAll();
                if($request->query->getAlnum('filter')){
                    $queryBuilder
                        ->where('bp.nomevent LIKE :nomevent')
                        ->setParameter('nomevent','%'.$request->query->getAlnum('filter').'%');
                }
                $query=$queryBuilder->getQuery();
                /**
                 * @var $paginator \Knp\Component\Pager\Paginator
                 */
                $paginator = $this->get('knp_paginator');
                $result=$paginator->paginate(
                    $query,
                    $request->query->getInt('page',1),
                    $request->query->getInt('limit',2)
                );
                return $this->render('@Event/EventViews/listAdmin.html.twig', array(
                    'events'=>$result,
                ));
            }
            else
                return $this->redirectToRoute('user_homepage');
        }
        return $this->redirectToRoute('user_homepage');

    }
    public function oldAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $listEvent = $this->getDoctrine()->getRepository(Event::class)->myfindByOldDate();
        $count = $this->getDoctrine()->getRepository(Event::class)->countOldExcursion();
        $event = $this->get('knp_paginator')->paginate(
            $listEvent,
            $request->query->get('page',1),6
        );
        return $this->render('@Event/event/oldEvent.html.twig', array(
            'events' => $event,
            'num' => $count,
        ));

    }
    public function newadminAction(Request $request)
    {
        $user = $this->getUser();

        $listRando = $this->getDoctrine()->getRepository(Event::class)->myFindByNewDate();
        $count = $this->getDoctrine()->getRepository(Event::class)->countNewEvent();

        $event = $this->get('knp_paginator')->paginate(
            $listRando,
            $request->query->get('page',1),10
        );

        if($user == null)
        {
            return $this->redirectToRoute('event_index', array(
                'events' => $event,
                'count' => $count
            ));
        }
        else if($user->getRoles()[0] == 'ROLE_ADMIN')
        {
            //$randonne = new Randonne();
            $new = $this->getDoctrine()->getRepository(Event::class)->countNewEvent();
            $old = $this->getDoctrine()->getRepository(Event::class)->countOldEvent();
            $sum = $this->getDoctrine()->getRepository(Event::class)->countAllEvent();



            return $this->render('@Event/event/listAdmin.html.twig', array(
                'event' => $event,
                'newcount' => $new,
                'oldcount' => $old,
                'sumcount' => $sum,
            ));
        }
        else
            return $this->render('@Event/event/index.html.twig');
    }
    public function savedEventAction()
    {
        $user = $this->getUser();
        if($user != null)
        {
            if($user->getRoles()[0] == 'ROLE_USER')
            {
                $my = $this->getDoctrine()
                    ->getRepository(Event::class)
                    ->getAllMyEvents($user->getId());

                $event = $this->getDoctrine()
                    ->getRepository(Event::class)
                    ->myFindEvent($my);

                $old = array();
                $new = array();
                foreach($event as $n)
                {
                    $date = $n->getDateevent();
                    $Date = \DateTime::createFromFormat('Y-m-d', $date)->format('Y-m-d');
                    $today = date("Y-m-d");

                    if($Date > $today)
                        $new[] = $n;
                    else
                        $old[] = $n;
                }
                return $this->render('@Event/EventViews/savedEvent.html.twig', array(
                    'my' => $new,
                    'old' => $old,
                ));
            }
            else if($user->getRoles()[0] == 'ROLE_ADMIN')
                return $this->redirectToRoute('user_homepage');
        }
        else
            return $this->redirectToRoute('fos_user_security_login');
    }

    public function cancelAction($idevent)
    {
        //die('id: '.$randonne->getIdrando())
        //die("here");
        $user = $this->getUser();
        if($user != null)
        {
            $idUser = $user->getId();
            //$idEvent = $event->getIdevent();

            $em = $this->getDoctrine()->getManager();
            $reservation =$em->getRepository(Reservationevent::class)->myFindMe($idUser,$idevent);
            $em->remove($reservation[0]);

            $nbrePersonnes = $em->getRepository(Event::class)->getAllAboutEvent($idevent);
            //die('nb '.);
            $event = $this->getDoctrine()->getRepository(Event::class)->find($idevent);
            $new = $nbrePersonnes[0]->getNbrepersonnes()-1;
            //die('new '.$new);
            $event->setNbrepersonnes($new);
            //die('new : '.$randonne->getNbreclient());
            $this->getDoctrine()->getManager()->flush();
            $em->flush();
            return $this->redirectToRoute('saved_event');
        }
        else
            return $this->redirectToRoute('fos_user_security_login');
    }
 }

