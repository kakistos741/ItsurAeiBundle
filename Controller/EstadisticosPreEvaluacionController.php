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
class EstadisticosPreEvaluacionController extends Controller
{

    /**
     * @Route("/index", name="estadisticos_index")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $id = $this->container->getParameter('periodo.actual');
        $periodo = $this->getDoctrine()->getRepository('ItsurAeiBundle:Periodo')->find($id);
        
        return array();
    }


    /**
     * @Route("/carreras", name="estadisticos_carreras")
     * @Template()
     */
    public function carrerasAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $id = $this->container->getParameter('periodo.actual');
        $periodo = $this->getDoctrine()->getRepository('ItsurAeiBundle:Periodo')->find($id);
        
        $query = $this->getDoctrine()->getEntityManager()
       ->createQuery("
            SELECT  a.carrera, COUNT(a.ficha) as cantidad FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            JOIN a.hoja h
            WHERE  p.id = :periodo
            GROUP BY a.carrera
            ORDER BY cantidad DESC"
        )->setParameter('periodo', $periodo);

        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->count($id);

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodo);
    }

    /**
     * @Route("/lugarorigen", name="estadisticos_lugarorigen")
     * @Template()
     */
    public function lugarOrigenAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $id = $this->container->getParameter('periodo.actual');
        $periodo = $this->getDoctrine()->getRepository('ItsurAeiBundle:Periodo')->find($id);
        
        $query = $this->getDoctrine()->getEntityManager()
        ->createQuery("
            SELECT  a.lugarOrigen, COUNT(a.ficha) as cantidad FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            WHERE  p.id = :periodo
            GROUP BY a.lugarOrigen
            ORDER BY cantidad DESC"
        )->setParameter('periodo', $periodo);

        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->count($id);

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodo);
    }

    /**
     * @Route("/lugarorigen/{carrera}", name="estadisticos_lugarorigen_carrera")
     * @Template()
     */
    public function lugarOrigenCarreraAction($carrera)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $id = $this->container->getParameter('periodo.actual');
        $periodo = $this->getDoctrine()->getRepository('ItsurAeiBundle:Periodo')->find($id);
        
        $query = $this->getDoctrine()->getEntityManager()
        ->createQuery("
            SELECT  a.lugarOrigen, COUNT(a.ficha) as cantidad FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            WHERE  p.id = :periodo
                AND a.carrera = :carrera
            GROUP BY a.lugarOrigen
            ORDER BY cantidad DESC"
        )
        ->setParameter('carrera', $carrera)
        ->setParameter('periodo', $periodo);

        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countByCarrera($id, $carrera);

        return  array('datos'=> $datos, 'carrera'=>$carrera, 'total'=>$total[0][1], 
            'periodo'=>$periodo);
    }

    /**
     * @Route("/escuelaprocedencia", name="estadisticos_escuelaprocedencia")
     * @Template()
     */
    public function escuelaProcedenciaAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $id = $this->container->getParameter('periodo.actual');
        $periodo = $this->getDoctrine()->getRepository('ItsurAeiBundle:Periodo')->find($id);
        
        $query = $this->getDoctrine()->getEntityManager()
        ->createQuery("
            SELECT  a.escuelaProcedencia, COUNT(a.ficha) as cantidad  FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            WHERE  p.id = :periodo
            GROUP BY a.escuelaProcedencia
            ORDER BY cantidad DESC"
        )->setParameter('periodo', $periodo);

        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->count($id);

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodo);
    }

    /**
     * @Route("/escuelaprocedencia/{carrera}", name="estadisticos_escuelaprocedencia_carrera")
     * @Template()
     */
    public function escuelaProcedenciaCarreraAction($carrera)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $id = $this->container->getParameter('periodo.actual');
        $periodo = $this->getDoctrine()->getRepository('ItsurAeiBundle:Periodo')->find($id);
        
        $query = $this->getDoctrine()->getEntityManager()
        ->createQuery("
            SELECT  a.escuelaProcedencia, COUNT(a.ficha) as cantidad FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            WHERE  p.id = :periodo
                AND a.carrera = :carrera
            GROUP BY a.escuelaProcedencia
            ORDER BY cantidad DESC"
        )
        ->setParameter('carrera', $carrera)
        ->setParameter('periodo', $periodo);

        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countByCarrera($id, $carrera);

        return  array('datos'=> $datos, 'carrera'=>$carrera, 'total'=>$total[0][1], 'periodo'=>$periodo);
    }


    /**
     * @Route("/bachillerato", name="estadisticos_bachillerato")
     * @Template()
     */
    public function bachilleratoAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $id = $this->container->getParameter('periodo.actual');
        $periodo = $this->getDoctrine()->getRepository('ItsurAeiBundle:Periodo')->find($id);
        
        $query = $this->getDoctrine()->getEntityManager()
        ->createQuery("
            SELECT  a.bachillerato, COUNT(a.ficha) as cantidad FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            WHERE  p.id = :periodo
            GROUP BY a.bachillerato
            ORDER BY cantidad DESC"
        )->setParameter('periodo', $periodo);

        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->count($id);


        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodo);
    }

    /**
     * @Route("/bachillerato/{carrera}", name="estadisticos_bachillerato_carrera")
     * @Template()
     */
    public function bachilleratoCarreraAction($carrera)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $id = $this->container->getParameter('periodo.actual');
        $periodo = $this->getDoctrine()->getRepository('ItsurAeiBundle:Periodo')->find($id);
        
        $query = $this->getDoctrine()->getEntityManager()
        ->createQuery("
            SELECT  a.bachillerato, COUNT(a.ficha) as cantidad FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            WHERE  p.id = :periodo
                AND a.carrera = :carrera
            GROUP BY a.bachillerato
            ORDER BY cantidad DESC"
        )
        ->setParameter('carrera', $carrera)
        ->setParameter('periodo', $periodo);

        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countByCarrera($id, $carrera);

        return  array('datos'=> $datos, 'carrera'=>$carrera, 'total'=>$total[0][1], 'periodo'=>$periodo);
    }


    /**
     * @Route("/genero", name="estadisticos_genero")
     * @Template()
     */
    public function generoAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $id = $this->container->getParameter('periodo.actual');
        $periodo = $this->getDoctrine()->getRepository('ItsurAeiBundle:Periodo')->find($id);
        
        $query = $this->getDoctrine()->getEntityManager()
        ->createQuery("
            SELECT  a.genero, COUNT(a.ficha) as cantidad FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            WHERE  p.id = :periodo
            GROUP BY a.genero
            ORDER BY cantidad DESC"
        )->setParameter('periodo', $periodo);

        $datos = $query->getResult();
        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->count($id);

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodo);
    }

    /**
     * @Route("/genero/{carrera}", name="estadisticos_genero_carrera")
     * @Template()
     */
    public function generoCarreraAction($carrera)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $id = $this->container->getParameter('periodo.actual');
        $periodo = $this->getDoctrine()->getRepository('ItsurAeiBundle:Periodo')->find($id);
        
        $query = $this->getDoctrine()->getEntityManager()
        ->createQuery("
            SELECT  a.genero, COUNT(a.ficha) as cantidad FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            WHERE  p.id = :periodo
               AND a.carrera = :carrera
            GROUP BY a.genero
            ORDER BY cantidad DESC"
        )
        ->setParameter('carrera', $carrera)
        ->setParameter('periodo', $periodo);

        $datos = $query->getResult();
        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countByCarrera($id, $carrera);

        return  array('datos'=> $datos, 'carrera'=>$carrera, 'total'=>$total[0][1], 'periodo'=>$periodo);
    }



    /**
     * @Route("/promedioBachillerato", name="estadisticos_promediobachillerato")
     * @Template()
     */
    public function promedioBachilleratoAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $id = $this->container->getParameter('periodo.actual');
        $periodo = $this->getDoctrine()->getRepository('ItsurAeiBundle:Periodo')->find($id);
        
        $query = $this->getDoctrine()->getEntityManager()
        ->createQuery("
            SELECT  a.promedioBachillerato, COUNT(a.ficha) as cantidad FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            WHERE  p.id = :periodo
            GROUP BY a.promedioBachillerato
            ORDER BY cantidad DESC"
        )->setParameter('periodo', $periodo);

        $datos = $query->getResult();
        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->count($id);

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodo);
    }
}
