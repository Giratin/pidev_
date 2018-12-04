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
