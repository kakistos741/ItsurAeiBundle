<?php

namespace Itsur\AeiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Leg\GoogleChartsBundle\Charts\Gallery\BarChart;
use Leg\GoogleChartsBundle\Charts\Gallery\PieChart;
use Leg\GoogleChartsBundle\Charts\Gallery\Pie\ThreeDimensionsChart;
use Itsur\AeiBundle\Entity\Utilerias;

/**
* @Route("/admin/pre/esta")
*/
class EstadisticosPreEvaluacionController extends Controller
{

    /**
     * @Route("/index", name="pre_estadisticos_index")
     * @Template()
     */
    public function indexAction()
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());
        
        return array('periodo'=>$periodoActual);
    }

        /**
     * @Route("/listado", name="listado_aspirantes")
     * @Template()
     */
    public function listadoAspirantesAction()
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());
        
        $aspirantes = $this->getDoctrine()->getRepository('ItsurAeiBundle:Aspirante')
        ->findAllByPeriodo($periodoActual->getId());

        return $this->render('ItsurAeiBundle:Administracion:listadoaspirantes.html.twig', array(
            'aspirantes'=> $aspirantes,
            'periodo'=>$periodoActual,
        ));
    }


    /**
     * @Route("/carreras", name="pre_estadisticos_carreras")
     * @Template()
     */
    public function carrerasAction()
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $em = $this->getDoctrine()->getEntityManager();
        $query = $this->getDoctrine()->getEntityManager()
       ->createQuery("
            SELECT  a.carrera, COUNT(a.ficha) as cantidad FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            WHERE  p.id = :periodo
            GROUP BY a.carrera
            ORDER BY cantidad DESC"
        )->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->count($periodoActual->getId());

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }

    /**
     * @Route("/lugarorigen", name="pre_estadisticos_lugarorigen")
     * @Template()
     */
    public function lugarOrigenAction()
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $em = $this->getDoctrine()->getEntityManager();
        $query = $this->getDoctrine()->getEntityManager()
        ->createQuery("
            SELECT  a.lugarOrigen, COUNT(a.ficha) as cantidad FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            WHERE  p.id = :periodo
            GROUP BY a.lugarOrigen
            ORDER BY cantidad DESC"
        )->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->count($periodoActual->getId());

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }

    /**
     * @Route("/lugarorigen/{carrera}", name="pre_estadisticos_lugarorigen_carrera")
     * @Template()
     */
    public function lugarOrigenCarreraAction($carrera)
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $em = $this->getDoctrine()->getEntityManager();
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
        ->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countByCarrera($periodoActual->getId(), $carrera);

        return  array('datos'=> $datos, 'carrera'=>$carrera, 'total'=>$total[0][1], 
            'periodo'=>$periodoActual);
    }

    /**
     * @Route("/escuelaprocedencia", name="pre_estadisticos_escuelaprocedencia")
     * @Template()
     */
    public function escuelaProcedenciaAction()
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $em = $this->getDoctrine()->getEntityManager();
        $query = $this->getDoctrine()->getEntityManager()
        ->createQuery("
            SELECT  a.escuelaProcedencia, COUNT(a.ficha) as cantidad  FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            WHERE  p.id = :periodo
            GROUP BY a.escuelaProcedencia
            ORDER BY cantidad DESC"
        )->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->count($periodoActual->getId());

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }

    /**
     * @Route("/escuelaprocedencia/{carrera}", name="pre_estadisticos_escuelaprocedencia_carrera")
     * @Template()
     */
    public function escuelaProcedenciaCarreraAction($carrera)
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $em = $this->getDoctrine()->getEntityManager();
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
        ->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countByCarrera($periodoActual->getId(), $carrera);

        return  array('datos'=> $datos, 'carrera'=>$carrera, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }


    /**
     * @Route("/bachillerato", name="pre_estadisticos_bachillerato")
     * @Template()
     */
    public function bachilleratoAction()
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $em = $this->getDoctrine()->getEntityManager();
        $query = $this->getDoctrine()->getEntityManager()
        ->createQuery("
            SELECT  a.bachillerato, COUNT(a.ficha) as cantidad FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            WHERE  p.id = :periodo
            GROUP BY a.bachillerato
            ORDER BY cantidad DESC"
        )->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->count($periodoActual->getId());


        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }

    /**
     * @Route("/bachillerato/{carrera}", name="pre_estadisticos_bachillerato_carrera")
     * @Template()
     */
    public function bachilleratoCarreraAction($carrera)
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $em = $this->getDoctrine()->getEntityManager();
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
        ->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countByCarrera($periodoActual->getId(), $carrera);

        return  array('datos'=> $datos, 'carrera'=>$carrera, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }


    /**
     * @Route("/genero", name="pre_estadisticos_genero")
     * @Template()
     */
    public function generoAction()
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $em = $this->getDoctrine()->getEntityManager();
        $query = $this->getDoctrine()->getEntityManager()
        ->createQuery("
            SELECT  a.genero, COUNT(a.ficha) as cantidad FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            WHERE  p.id = :periodo
            GROUP BY a.genero
            ORDER BY cantidad DESC"
        )->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();
        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->count($periodoActual->getId());

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }

    /**
     * @Route("/genero/{carrera}", name="pre_estadisticos_genero_carrera")
     * @Template()
     */
    public function generoCarreraAction($carrera)
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $em = $this->getDoctrine()->getEntityManager();
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
        ->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();
        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countByCarrera($periodoActual->getId(), $carrera);

        return  array('datos'=> $datos, 'carrera'=>$carrera, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }



    /**
     * @Route("/promedioBachillerato", name="pre_estadisticos_promediobachillerato")
     * @Template()
     */
    public function promedioBachilleratoAction()
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $em = $this->getDoctrine()->getEntityManager();
        $query = $this->getDoctrine()->getEntityManager()
        ->createQuery("
            SELECT  a.promedioBachillerato, COUNT(a.ficha) as cantidad FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            WHERE  p.id = :periodo
            GROUP BY a.promedioBachillerato
            ORDER BY cantidad DESC"
        )->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();
        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->count($periodoActual->getId());

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }

    /**
     * @Route("/preferenciasgenerocarrera", name="pre_estadisticos_preferencia_generos_carreras")
     * @Template()
     */
    public function preferenciaGeneroCarrerasAction()
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $em = $this->getDoctrine()->getEntityManager();
        $query = $this->getDoctrine()->getEntityManager()
        ->createQuery("
            SELECT  a.carrera, a.genero, COUNT(a.ficha) as cantidad FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            WHERE  p.id = :periodo
            GROUP BY a.carrera, a.genero
            ORDER BY a.carrera ASC, a.genero ASC"
        )->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();
        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->count($periodoActual->getId());

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }


    /**
     * @Route("/preferenciasgenerocarrera/{carrera}", name="pre_estadisticos_preferencia_generos_carrera")
     * @Template()
     */
    public function preferenciaGeneroCarreraAction($carrera)
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $em = $this->getDoctrine()->getEntityManager();
        $query = $this->getDoctrine()->getEntityManager()
        ->createQuery("
            SELECT  a.carrera, a.genero, COUNT(a.ficha) as cantidad FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            WHERE  p.id = :periodo
                AND a.carrera = :carrera 
            GROUP BY a.carrera, a.genero
            ORDER BY a.carrera ASC, a.genero ASC"
        )
        ->setParameter('carrera', $carrera)
        ->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();
        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countByCarrera($periodoActual->getId(), $carrera);

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }


    /**
     * @Route("/preferenciasbachilleratocarrera", name="pre_estadisticos_preferencia_bachillerato_carreras")
     * @Template()
     */
    public function preferenciaBachilleratoCarrerasAction()
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $em = $this->getDoctrine()->getEntityManager();
        $query = $this->getDoctrine()->getEntityManager()
        ->createQuery("
            SELECT  a.bachillerato, a.carrera, COUNT(a.ficha) as cantidad FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            WHERE  p.id = :periodo
            GROUP BY a.bachillerato, a.carrera
            ORDER BY a.bachillerato ASC, a.carrera ASC"
        )->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();
        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->count($periodoActual->getId());

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }


    /**
     * @Route("/preferenciasbachilleratocarrera/{carrera}", name="pre_estadisticos_preferencia_bachillerato_carrera")
     * @Template()
     */
    public function preferenciaBachilleratoCarreraAction($carrera)
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $em = $this->getDoctrine()->getEntityManager();
        $query = $this->getDoctrine()->getEntityManager()
        ->createQuery("
            SELECT  a.bachillerato, a.carrera, COUNT(a.ficha) as cantidad FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            WHERE  p.id = :periodo
                AND a.carrera = :carrera 
            GROUP BY a.bachillerato, a.carrera
            ORDER BY a.bachillerato ASC, a.carrera ASC"
        )
        ->setParameter('periodo', $periodoActual)
        ->setParameter('carrera', $carrera);

        $datos = $query->getResult();
        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countByCarrera($periodoActual->getId(), $carrera);

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }
}

