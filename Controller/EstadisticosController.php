<?php

namespace Itsur\AeiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Leg\GoogleChartsBundle\Charts\Gallery\BarChart;
use Leg\GoogleChartsBundle\Charts\Gallery\PieChart;
use Leg\GoogleChartsBundle\Charts\Gallery\Pie\ThreeDimensionsChart;

/**
* @Route("/admin/esta")
*/
class EstadisticosController extends Controller
{
    /**
     * @Route("/index", name="estadisticos_index")
     * @Template()
     */
    public function indexAction()
    {
    	$chart = new ThreeDimensionsChart();

        $chart  ->setWidth(500)
                ->setHeight(300)
                ->setDatas(array(200, 100, 50));

        $url = $this->get('leg_google_charts')->build($chart);

        return $this->render('ItsurAeiBundle:Estadisticos:index.html.twig', array(
            'chart_url' => $url
        ));

    }
}

