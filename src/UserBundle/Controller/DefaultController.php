<?php

namespace UserBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use ExcursionBundle\Entity\Randonne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $u = $this->getUser();
        if($u)
        {
            if( $u->getRoles()[0] == 'ROLE_USER')
            {
                return $this->render('@User/Default/index.html.twig' , array(
                    'user' => $u
                ));
            }
            elseif ($u->getRoles()[0] == 'ROLE_ADMIN')
            {
                $top = $this->getDoctrine()->getRepository(Randonne::class)->topExcursion();
                $gain = $this->getDoctrine()->getRepository(Randonne::class)->gainNew();
                $old = $this->getDoctrine()->getRepository(Randonne::class)->gainOld();


                $data = array();
                $stat = ['Date','Ammount'];
                array_push($data, $stat);

                foreach ($gain as $row)
                {
                    $stat = array();
                    array_push($stat,$row->getDaterando(),$row->getDaterando());
                    //$amount[] = $row->getDestination();
                    //$date[] = $row->getDaterando();
                }



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


                return $this->render('@Admin/Default/index.html.twig', array(
                    'top' => $top,
                    'gain' => $gain,
                    'old' => $old,
                    'chart' => $pieChart,
                ));
            }
        }
        else
        {
            return $this->render('@User/Default/index.html.twig' , array(
                'user' => $u
            ));
        }
    }


    public function testAction()
    {
        $u = $this->getUser();

        return $this->render('@User/User/profile.html.twig', array(
            'user' => $u
        ));
    }
}
