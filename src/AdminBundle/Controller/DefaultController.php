<?php

namespace AdminBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Options\Chart;
use ExcursionBundle\Entity\Randonne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $user = $this->getUser();
        if($user == null )
            return $this->redirectToRoute('fos_user_security_login');
        if($user->getRoles()[0] == 'ROLE_USER')
            return $this->redirectToRoute('user_homepage');
        else
        {
            $top = $this->getDoctrine()->getRepository(Randonne::class)->topExcursion();
            $gain = $this->getDoctrine()->getRepository(Randonne::class)->gainNew();
            $old = $this->getDoctrine()->getRepository(Randonne::class)->gainOld();


            $date = array();
            $amount = array();
            foreach ($gain as $row)
            {
                $amount[] = $row->getDestination();
                $date[] = $row->getDaterando();
            }

            $data  = array();

            $data[] = [$amount, $date];
            //die(print_r($data));
            //$data[] = [ , ;

            //die(print_r($amount));
            $pieChart = new PieChart();
            $pieChart->getData()->setArrayToDataTable($data);
            $pieChart->getOptions()->setTitle('Active Excursions');
            $pieChart->getOptions()->setHeight(300);
            $pieChart->getOptions()->setWidth(500);
            $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
            $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
            $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
            $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
            $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);


            $col = new ColumnChart();
            //$col->
            $col->getData()->setArrayToDataTable(
                [
                    ['Time of Day', 'Motivation Level', ['role' => 'annotation'], 'Energy Level', ['role' => 'annotation']],
                    [['v' => [8, 0, 0], 'f' => '8 am'],  1, '1', 0.25, '0.2'],
                    [['v' => [9, 0, 0], 'f' => '9 am'],  2, '2',  0.5, '0.5'],
                    [['v' => [10, 0, 0], 'f' => '10 am'], 3, '3',    1,  '1'],
                    [['v' => [11, 0, 0], 'f' => '11 am'], 4, '4', 2.25,  '2'],
                    [['v' => [12, 0, 0], 'f' => '12 am'], 5, '5', 2.25,  '2'],
                    [['v' => [13, 0, 0], 'f' => '1 pm'],  6, '6',    3,  '3'],
                    [['v' => [14, 0, 0], 'f' => '2 pm'],  7, '7', 3.25,  '3'],
                    [['v' => [15, 0, 0], 'f' => '3 pm'],  8, '8',    5,  '5'],
                    [['v' => [16, 0, 0], 'f' => '4 pm'],  9, '9',  6.5,  '6'],
                    [['v' => [17, 0, 0], 'f' => '5 pm'], 10, '10',  10, '10']
                ]
            );
            $col->getOptions()->setTitle('Motivation and Energy Level Throughout the Day');
            $col->getOptions()->getAnnotations()->setAlwaysOutside(true);
            $col->getOptions()->getAnnotations()->getTextStyle()->setFontSize(14);
            $col->getOptions()->getAnnotations()->getTextStyle()->setColor('#000');
            $col->getOptions()->getAnnotations()->getTextStyle()->setAuraColor('none');
            $col->getOptions()->getHAxis()->setTitle('Time of Day');
            $col->getOptions()->getHAxis()->setFormat('h:mm a');
            $col->getOptions()->getHAxis()->getViewWindow()->setMin([7, 30, 0]);
            $col->getOptions()->getHAxis()->getViewWindow()->setMax([17, 30, 0]);
            $col->getOptions()->getVAxis()->setTitle('Rating (scale of 1-10)');
            $col->getOptions()->setWidth(400);
            $col->getOptions()->setHeight(300);


            return $this->render('@Admin/Default/index.html.twig', array(
                'top' => $top,
                'gain' => $gain,
                'old' => $old,
                'chart' => $pieChart,
                'col' => $col,
            ));
        }
    }


    public function usersAction(Request $request)
    {

        $user = $this->getUser();
        if($user == null )
            return $this->redirectToRoute('fos_user_security_login');
        if($user->getRoles()[0] == 'ROLE_USER')
            return $this->redirectToRoute('user_homepage');
        else
        {
            $em = $this->getDoctrine()->getManager();
            $users = $em->getRepository(User::class)->findAll();
            $count = $em->getRepository(User::class)->countUsers();
            $countB = $em->getRepository(User::class)->countBlockedUsers();
            $enabled = $em->getRepository(User::class)->countEnabledUsers();

            //die("nbre: ".print_r($enabled));

            $pagination = $this->get('knp_paginator')->paginate(
                $users,
                $request->query->get('page',1),6
            );

            return $this->render('@Admin/users.html.twig',array(
                'users' => $pagination,
                'count' => $count,
                'blocked' => $countB,
                'enabled' => $enabled,
            ));
        }
    }

    public function blockAction($id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        $mail = $user->getEmailCanonical();
        $usern = $user->getUsernameCanonical();

        $user->setEnabled("0");

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('users_page');
        //die("user ".$user->getNom()." is blocked");
    }

    public function unblockAction($id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        $mail = $user->getEmailCanonical();
        $usern = $user->getUsernameCanonical();

        $user->setEnabled("1");

        $this->getDoctrine()->getManager()->flush();

        //die('user: '.$user->getNom());
        return $this->redirectToRoute('users_page');
        //die("user ".$user->getNom()." is blocked");
    }

    public function blockedAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->BlockedUsers();
        $count = $em->getRepository(User::class)->countUsers();
        $countB = $em->getRepository(User::class)->countBlockedUsers();
        $enabled = $em->getRepository(User::class)->countEnabledUsers();

        $pagination = $this->get('knp_paginator')->paginate(
            $users,
            $request->query->get('page',1),6
        );

        return $this->render('@Admin/blocked.html.twig', array(
            'users' => $pagination,
            'count' => $count,
            'blocked' => $countB,
            'enabled' => $enabled,
        ));
    }

    public function enableAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->EnabledUsers();
        $count = $em->getRepository(User::class)->countUsers();
        $countB = $em->getRepository(User::class)->countBlockedUsers();
        $enabled = $em->getRepository(User::class)->countEnabledUsers();

        $pagination = $this->get('knp_paginator')->paginate(
            $users,
            $request->query->get('page',1),6
        );

        return $this->render('@Admin/enabled.html.twig', array(
            'users' => $pagination,
            'count' => $count,
            'blocked' => $countB,
            'enabled' => $enabled,
        ));
    }
}
