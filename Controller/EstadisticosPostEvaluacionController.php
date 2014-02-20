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
* @Route("/admin/post/esta")
*/
class EstadisticosPostEvaluacionController extends Controller
{

    /**
     * @Route("/index", name="post_estadisticos_index")
     * @Template()
     */
    public function indexAction()
    {
     
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());
        
        return array('periodo'=>$periodoActual);
    }

    /**
     * @Route("/listadocalificaciones", name="calificaciones_aspirantes")
     * @Template()
     */
    public function calificacionesAspirantesAction()
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $aspirantes = $this->getDoctrine()->getRepository('ItsurAeiBundle:Aspirante')
        ->findAllByPeriodoWithHoja($periodoActual->getId());

        return array(
            'aspirantes'=> $aspirantes,
            'periodo'=>$periodoActual,
            
        );
    }


    /**
     * @Route("/carreras", name="post_estadisticos_carreras")
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
            JOIN a.hoja h
            WHERE  p.id = :periodo
            GROUP BY a.carrera
            ORDER BY cantidad DESC"
        )->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countWithHoja($periodoActual->getId());

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }

    /**
     * @Route("/lugarorigen", name="post_estadisticos_lugarorigen")
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
            JOIN a.hoja h
            WHERE  p.id = :periodo
            GROUP BY a.lugarOrigen
            ORDER BY cantidad DESC"
        )->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countWithHoja($periodoActual->getId());

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }

    /**
     * @Route("/lugarorigen/{carrera}", name="post_estadisticos_lugarorigen_carrera")
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
            JOIN a.hoja h
            WHERE  p.id = :periodo
                AND a.carrera = :carrera
            GROUP BY a.lugarOrigen
            ORDER BY cantidad DESC"
        )
        ->setParameter('carrera', $carrera)
        ->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countByCarreraWithHoja($periodoActual->getId(), $carrera);

        return  array('datos'=> $datos, 'carrera'=>$carrera, 'total'=>$total[0][1], 
            'periodo'=>$periodoActual);
    }

    /**
     * @Route("/escuelaprocedencia", name="post_estadisticos_escuelaprocedencia")
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
            JOIN a.hoja h
            WHERE  p.id = :periodo
            GROUP BY a.escuelaProcedencia
            ORDER BY cantidad DESC"
        )->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countWithHoja($periodoActual->getId());

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }

    /**
     * @Route("/escuelaprocedencia/{carrera}", name="post_estadisticos_escuelaprocedencia_carrera")
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
            JOIN a.hoja h
            WHERE  p.id = :periodo
                AND a.carrera = :carrera
            GROUP BY a.escuelaProcedencia
            ORDER BY cantidad DESC"
        )
        ->setParameter('carrera', $carrera)
        ->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countByCarreraWithHoja($periodoActual->getId(), $carrera);

        return  array('datos'=> $datos, 'carrera'=>$carrera, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }


    /**
     * @Route("/bachillerato", name="post_estadisticos_bachillerato")
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
            JOIN a.hoja h
            WHERE  p.id = :periodo
            GROUP BY a.bachillerato
            ORDER BY cantidad DESC"
        )->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countWithHoja($periodoActual->getId());


        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }

    /**
     * @Route("/bachillerato/{carrera}", name="post_estadisticos_bachillerato_carrera")
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
            JOIN a.hoja h
            WHERE  p.id = :periodo
                AND a.carrera = :carrera
            GROUP BY a.bachillerato
            ORDER BY cantidad DESC"
        )
        ->setParameter('carrera', $carrera)
        ->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countByCarreraWithHoja($periodoActual->getId(), $carrera);

        return  array('datos'=> $datos, 'carrera'=>$carrera, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }


    /**
     * @Route("/genero", name="post_estadisticos_genero")
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
            JOIN a.hoja h
            WHERE  p.id = :periodo
            GROUP BY a.genero
            ORDER BY cantidad DESC"
        )->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();
        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countWithHoja($periodoActual->getId());

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }

    /**
     * @Route("/genero/{carrera}", name="post_estadisticos_genero_carrera")
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
            JOIN a.hoja h
            WHERE  p.id = :periodo
               AND a.carrera = :carrera
            GROUP BY a.genero
            ORDER BY cantidad DESC"
        )
        ->setParameter('carrera', $carrera)
        ->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();
        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countByCarreraWithHoja($periodoActual->getId(), $carrera);

        return  array('datos'=> $datos, 'carrera'=>$carrera, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }



    /**
     * @Route("/promedioBachillerato", name="post_estadisticos_promediobachillerato")
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
            JOIN a.hoja h
            WHERE  p.id = :periodo
            GROUP BY a.promedioBachillerato
            ORDER BY cantidad DESC"
        )->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();
        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countWithHoja($periodoActual->getId());

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }

    /**
     * @Route("/preferenciasgenerocarrera", name="post_estadisticos_preferencia_generos_carreras")
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
            JOIN a.hoja h
            WHERE  p.id = :periodo
            GROUP BY a.carrera, a.genero
            ORDER BY a.carrera ASC, a.genero ASC"
        )->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();
        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countWithHoja($periodoActual->getId());

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }


    /**
     * @Route("/preferenciasgenerocarrera/{carrera}", name="post_estadisticos_preferencia_generos_carrera")
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
            JOIN a.hoja h
            WHERE  p.id = :periodo
                AND a.carrera = :carrera 
            GROUP BY a.carrera, a.genero
            ORDER BY a.carrera ASC, a.genero ASC"
        )
        ->setParameter('carrera', $carrera)
        ->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();
        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countByCarreraWithHoja($periodoActual->getId(), $carrera);

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }


    /**
     * @Route("/preferenciasbachilleratocarrera", name="post_estadisticos_preferencia_bachillerato_carreras")
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
            JOIN a.hoja h
            WHERE  p.id = :periodo
            GROUP BY a.bachillerato, a.carrera
            ORDER BY a.bachillerato ASC, a.carrera ASC"
        )->setParameter('periodo', $periodoActual);

        $datos = $query->getResult();
        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countWithHoja($periodoActual->getId());

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }


    /**
     * @Route("/preferenciasbachilleratocarrera/{carrera}", name="post_estadisticos_preferencia_bachillerato_carrera")
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
            JOIN a.hoja h
            WHERE  p.id = :periodo
                AND a.carrera = :carrera 
            GROUP BY a.bachillerato, a.carrera
            ORDER BY a.bachillerato ASC, a.carrera ASC"
        )
        ->setParameter('periodo', $periodoActual)
        ->setParameter('carrera', $carrera);

        $datos = $query->getResult();
        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countByCarreraWithHoja($periodoActual->getId(), $carrera);

        return  array('datos'=> $datos, 'total'=>$total[0][1], 'periodo'=>$periodoActual);
    }

    /**
     * @Route("/estadisticosAreas", name="post_estadisticos_Areas")
     * @Template()
     */
    public function estadisticosAreasAction()
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $em = $this->getDoctrine()->getEntityManager();

        //Recuperamos los minimos
        $minimosAreas = $this->getDoctrine()->getRepository('ItsurAeiBundle:AreaEvaluable')
            ->minimumAreasByPeriodo($periodoActual->getId());

        $minimosAreas = Utilerias::procesarResultadoFuncionResumen($minimosAreas,'area', 'minimo');


        //Recuperamos los promedios
        $promediosAreas = $this->getDoctrine()->getRepository('ItsurAeiBundle:AreaEvaluable')
            ->avegareAreasByPeriodo($periodoActual->getId());

        $promediosAreas = Utilerias::procesarResultadoFuncionResumen($promediosAreas,'area', 'promedio');

        //Recuperamos los maximos
        $maximosAreas = $this->getDoctrine()->getRepository('ItsurAeiBundle:AreaEvaluable')
            ->maximumAreasByPeriodo($periodoActual->getId());

        $maximosAreas = Utilerias::procesarResultadoFuncionResumen($maximosAreas,'area', 'maximo');


         //standarDesviationAreasByPeriodo
        //Recuperamos los maximos
        $desviacionesAreas = $this->getDoctrine()->getRepository('ItsurAeiBundle:AreaEvaluable')
            ->standarDesviationAreasByPeriodo($periodoActual->getId());

        $desviacionesAreas = Utilerias::procesarResultadoFuncionResumen($desviacionesAreas,'area', 'desviacion');
  

        $cantidadAspirantes = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countWithHoja($periodoActual->getId());
        return array(
            'periodo'=>$periodoActual,
            'minimosAreas'=> $minimosAreas, 
            'promediosAreas'=> $promediosAreas,
            'maximosAreas'=> $maximosAreas,
            'desviacionesAreas'=>$desviacionesAreas, 
            'total' =>$cantidadAspirantes[0][1],
        );
    }


     /**
     * @Route("/estadisticosAreas/{carrera}", name="post_estadisticos_Areas_carrera")
     * @Template()
     */
    public function estadisticosAreasCarreraAction($carrera)
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $em = $this->getDoctrine()->getEntityManager();
        
        //Recuperamos minimos
        $minimosAreas = $this->getDoctrine()->getRepository('ItsurAeiBundle:AreaEvaluable')
            ->minimumAreasByPeriodoAndCarrera($periodoActual->getId(), $carrera);

        $minimosAreas = Utilerias::procesarResultadoFuncionResumen($minimosAreas,'area', 'minimo');


        //Recuperamos promedios
        $promediosAreas = $this->getDoctrine()->getRepository('ItsurAeiBundle:AreaEvaluable')
            ->avegareAreasByPeriodoAndCarrera($periodoActual->getId(), $carrera);

        $promediosAreas = Utilerias::procesarResultadoFuncionResumen($promediosAreas,'area', 'promedio');

        //Recuperamos maximos
        $maximosAreas = $this->getDoctrine()->getRepository('ItsurAeiBundle:AreaEvaluable')
            ->maximumAreasByPeriodoAndCarrera($periodoActual->getId(), $carrera);

        $maximosAreas = Utilerias::procesarResultadoFuncionResumen($maximosAreas,'area', 'maximo');


        $cantidadAspirantes = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countByCarreraWithHoja($periodoActual->getId(), $carrera);
        return array(
            'periodo'=>$periodoActual,
            'carrera'=>$carrera,
            'minimosAreas'=> $minimosAreas, 
            'promediosAreas'=> $promediosAreas,
            'maximosAreas'=> $maximosAreas,  
            'total' =>$cantidadAspirantes[0][1],
        );
    }

    /**
     * @Route("/estadisticosTemas", name="post_estadisticos_Temas")
     * @Template()
     */
    public function estadisticosTemasAction()
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $em = $this->getDoctrine()->getEntityManager();

        //Recuperamos minimos
        $minimosTemas = $this->getDoctrine()->getRepository('ItsurAeiBundle:TemaEvaluable')
            ->minimumTemasByPeriodo($periodoActual->getId());

        $minimosTemas = Utilerias::procesarResultadoFuncionResumen($minimosTemas,'tema', 'minimo');

        //Recuperamos promedios
        $promediosTemas = $this->getDoctrine()->getRepository('ItsurAeiBundle:TemaEvaluable')
            ->avegareTemasByPeriodo($periodoActual->getId());

        $promediosTemas = Utilerias::procesarResultadoFuncionResumen($promediosTemas,'tema', 'promedio');

        //Recuperamos maximos
        $maximosTemas = $this->getDoctrine()->getRepository('ItsurAeiBundle:TemaEvaluable')
            ->maximumTemasByPeriodo($periodoActual->getId());

        $maximosTemas = Utilerias::procesarResultadoFuncionResumen($maximosTemas,'tema', 'maximo');


        $cantidadAspirantes = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countWithHoja($periodoActual->getId());
        return array(
            'periodo'=>$periodoActual,
            'minimosTemas'=> $minimosTemas, 
            'promediosTemas'=> $promediosTemas, 
            'maximosTemas'=> $maximosTemas, 
            'total' =>$cantidadAspirantes[0][1],
        );
    }


    /**
     * @Route("/estadisticosTemas/{carrera}", name="post_estadisticos_Temas_carrera")
     * @Template()
     */
    public function estadisticosTemasCarreraAction($carrera)
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $em = $this->getDoctrine()->getEntityManager();

        //Recuperamos minimos
        $minimosTemas = $this->getDoctrine()->getRepository('ItsurAeiBundle:TemaEvaluable')
            ->minimumTemasByPeriodoAndCarrera($periodoActual->getId(), $carrera);

        $minimosTemas = Utilerias::procesarResultadoFuncionResumen($minimosTemas,'tema', 'minimo');

        //Recuperamos los promedios
        $promediosTemas = $this->getDoctrine()->getRepository('ItsurAeiBundle:TemaEvaluable')
            ->avegareTemasByPeriodoAndCarrera($periodoActual->getId(), $carrera);

        $promediosTemas = Utilerias::procesarResultadoFuncionResumen($promediosTemas,'tema', 'promedio');

        //Recuperamos maximos
        $maximosTemas = $this->getDoctrine()->getRepository('ItsurAeiBundle:TemaEvaluable')
            ->maximumTemasByPeriodoAndCarrera($periodoActual->getId(), $carrera);

        $maximosTemas = Utilerias::procesarResultadoFuncionResumen($maximosTemas,'tema', 'maximo');

        $cantidadAspirantes = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countByCarreraWithHoja($periodoActual->getId(), $carrera);
        return array(
            'periodo'=>$periodoActual,
            'carrera'=>$carrera,
            'minimosTemas'=> $minimosTemas, 
            'promediosTemas'=> $promediosTemas, 
            'maximosTemas'=> $maximosTemas, 
            'total' =>$cantidadAspirantes[0][1],
        );
    }


    /**
     * @Route("/calificacionesCuartiles", name="calificaciones_cuartiles_aspirantes")
     * @Template()
     */
    public function calificacionesCuartilesAspirantesAction()
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $aspirantes = $this->getDoctrine()->getRepository('ItsurAeiBundle:Aspirante')
        ->findAllOrderedCalificacionByPeriodoWithHoja($periodoActual->getId());

        $desviacion = $this->getDoctrine()->getRepository('ItsurAeiBundle:HojaRespuestas')
        ->desviationCalificacionByPeriodo($periodoActual->getId());

        $media = $this->getDoctrine()->getRepository('ItsurAeiBundle:HojaRespuestas')
        ->averageCalificacionByPeriodo($periodoActual->getId());


        $cantidadAspirantes = $this->getDoctrine()->getRepository('ItsurAeiBundle:Aspirante')->countWithHoja($periodoActual->getId());

        return array(
            'aspirantes'=> $aspirantes,
            'periodo'=>$periodoActual,
            'total'=>$cantidadAspirantes[0][1],
            'media'=>$media[0][1],
            'desviacion'=>$desviacion[0][1],
        );
    }

    /**
     * @Route("/calificacionesCuartiles/{carrera}", name="calificaciones_cuartiles_carrera_aspirantes")
     * @Template()
     */
    public function calificacionesCuartilesCarreraAspirantesAction($carrera)
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $aspirantes = $this->getDoctrine()->getRepository('ItsurAeiBundle:Aspirante')
        ->findAllOrderedCalificacionByPeriodoAndCarreraWithHoja($periodoActual->getId(), $carrera);

        $cantidadAspirantes = $this->getDoctrine()->getRepository('ItsurAeiBundle:Aspirante')->countByCarreraWithHoja($periodoActual->getId(), $carrera);

        return array(
            'aspirantes'=> $aspirantes,
            'periodo'=>$periodoActual,
            'carrera'=>$carrera,
            'total'=>$cantidadAspirantes[0][1],
        );
    }

    /**
     * @Route("/resultadosMatematicas/", name="post_estadisticos_matematicas")
     * @Template()
     */
    public function resultadosMatematicasAction()
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $em = $this->getDoctrine()->getEntityManager();

        $query = $this->getDoctrine()->getEntityManager()
        ->createQuery("
            SELECT  t, mp, m, a, s
            FROM ItsurAeiBundle:ManualPeriodo mp
            JOIN mp.manual m 
            JOIN m.areas a
            JOIN a.secciones s
            JOIN s.temas t
            JOIN mp.periodo p
            WHERE  p.id = :periodo
                AND a.nombre like 'Matematicas'
            ORDER BY t.nombre ASC"
        )->setParameter('periodo', $periodoActual);
        $nombresTemas = $query->getResult();

        $query = $this->getDoctrine()->getEntityManager()
        ->createQuery("
            SELECT  asp, h, ae, se, te, a, t
            FROM ItsurAeiBundle:Aspirante asp
            JOIN asp.periodo p
            JOIN asp.hoja h
            JOin h.areas ae
            JOIN ae.secciones se
            JOIN se.temas te
            JOIN ae.area a
            JOIN te.tema t
            WHERE  p.id = :periodo
                AND a.nombre like 'Matematicas'
            ORDER BY asp.ficha ASC, t.nombre ASC"
        )->setParameter('periodo', $periodoActual);
        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countWithHoja($periodoActual->getId());

        return  array(
            'aspirantes'=> $datos, 
            'total'=>$total[0][1], 
            'periodo'=>$periodoActual,
            'nombresTemas'=>$nombresTemas,
        );
    }


     /**
     * @Route("/resultadosMatematicas/{carrera}", name="post_estadisticos_matematicas_carrera")
     * @Template()
     */
    public function resultadosMatematicasCarreraAction($carrera)
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $em = $this->getDoctrine()->getEntityManager();

        $query = $this->getDoctrine()->getEntityManager()
        ->createQuery("
            SELECT  t, mp, m, a, s
            FROM ItsurAeiBundle:ManualPeriodo mp
            JOIN mp.manual m 
            JOIN m.areas a
            JOIN a.secciones s
            JOIN s.temas t
            JOIN mp.periodo p
            WHERE  p.id = :periodo
                AND a.nombre like 'Matematicas'
            ORDER BY t.nombre ASC"
        )->setParameter('periodo', $periodoActual);
        $nombresTemas = $query->getResult();

        $query = $this->getDoctrine()->getEntityManager()
        ->createQuery("
            SELECT  asp, h, ae, se, te, a, t
            FROM ItsurAeiBundle:Aspirante asp
            JOIN asp.periodo p
            JOIN asp.hoja h
            JOin h.areas ae
            JOIN ae.secciones se
            JOIN se.temas te
            JOIN ae.area a
            JOIN te.tema t
            WHERE  p.id = :periodo
                AND a.nombre like 'Matematicas'
                AND asp.carrera = :carrera
            ORDER BY asp.ficha ASC, t.nombre ASC"
        )->setParameter('carrera', $carrera)
        ->setParameter('periodo', $periodoActual);
        $datos = $query->getResult();

        $total = $repository = $em->getRepository('ItsurAeiBundle:Aspirante')->countByCarreraWithHoja($periodoActual->getId(),$carrera);

        return  array(
            'aspirantes'=> $datos, 
            'total'=>$total[0][1], 
            'carrera'=>$carrera,
            'periodo'=>$periodoActual,
            'nombresTemas'=>$nombresTemas,
        );
    }
}

