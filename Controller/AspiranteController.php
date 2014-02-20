<?php

namespace Itsur\AeiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Itsur\AeiBundle\Entity\Aspirante;
use Itsur\AeiBundle\Entity\Utilerias;
use Itsur\AeiBundle\Form\AspiranteType;

/**
 * @Route("/admin/aspirantes")
 */
class AspiranteController extends Controller
{

    /**
     * @Route("/new", defaults={"next"="sucess"}),
     * @Route("/new/{next}", name="aspirante_new")
     * @Template()
     */
    public function newAction($next, Request $request)
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());
        
        $em = $this->getDoctrine()->getEntityManager();
        $aspirante = new Aspirante();
        $aspirante->setPeriodo($periodoActual);

        $form = $this->createForm(new AspiranteType(), $aspirante);
            
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {

                $existeFicha = $em->getRepository('ItsurAeiBundle:Aspirante')->findByPeriodoAndFicha($periodoActual->getId(), $aspirante->getId());

                if(is_null($existeFicha)){

                   $aspirante->setPeriodo($periodoActual);
                   $em->persist($aspirante);
                   $em->flush();
                   return $this->redirect($this->generateUrl('aspirante_sucess'));
                   
                }else{
                    return $this->render('ItsurAeiBundle:Aspirante:yaexisteficha.html.twig',array(
                        'aspirante'=> $aspirante,
                        'periodo'=>$periodoActual,
                    ));
                }
            }
            
        }

        return $this->render('ItsurAeiBundle:Aspirante:new.html.twig',array(
            'form'=> $form->createView(),
            'next'=> $next,
            'periodo'=>$periodoActual,
        ));
    }
    

    /**
     * @Route("/update/{ficha}", name="aspirante_update")
     * @Template()
     */
    public function updateAction($ficha, Request $request)
    {

        $em = $this->getDoctrine()->getEntityManager();
        $aspirante = $em->getRepository('ItsurAeiBundle:Aspirante')->find($ficha);

        if(!$aspirante){
            throw $this->createNotFoundException('No se encontró el aspirante con la ficha '.$ficha);
        }

        $form = $this->createForm(new AspiranteType(), $aspirante);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em->flush();
                return $this->redirect($this->generateUrl('aspirante_sucess'));
            }

        }

        return $this->render('ItsurAeiBundle:Aspirante:update.html.twig',array(
        'form'=> $form->createView(),
        ));
    }

    /**
     * @Route("/{ficha}/show/", name="aspirante_show")
     * @Template()
     */
    public function showAction($ficha)
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());
        $aspirante = $this->getDoctrine()->getRepository('ItsurAeiBundle:Aspirante')
        ->findByPeriodoAndFicha($periodoActual->getId(), $ficha);

        if(!$aspirante){
            throw $this->createNotFoundException('No se encontró el aspirante con la ficha '.$ficha);
        }
        return $this->render('ItsurAeiBundle:Aspirante:show.html.twig',array(
            'periodo'=>$periodoActual,
            'aspirante'=> $aspirante,
        ));
    }
    /**
     * @Route("/list", defaults={"carrera"="TODAS", "order"="asc"}),
     * @Route("/list/{carrera}/{order}", name="aspirante_list") 
     * @Template()
     */
    public function listAction($carrera, $order)
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());
        $repository = $this->getDoctrine()->getRepository('ItsurAeiBundle:Aspirante');

        if($order == "asc"){
           if($carrera == "TODAS"){
               $aspirantes =  $repository->findAllOrderedNameByPeriodo($periodoActual->getId());
           }else{
               $aspirantes = $repository->findAllOrderedNameByPeriodoAndCarrera($periodoActual->getId(), $carrera);
           }  
        }elseif($order == "desc"){
           if($carrera == "TODAS"){
               $aspirantes =  $repository->findAllOrderedNameDescByPeriodo($periodoActual->getId());
           }else{
               $aspirantes = $repository->findAllOrderedNameDescByPeriodoAndCarrera($periodoActual->getId(), $carrera);
           }  
        }else{
           if($carrera == "TODAS"){
               $aspirantes =  $repository->findAllByPeriodo($periodoActual->getId());
           }else{
               $aspirantes =  $repository->findAllByPeriodoAndCarrera($periodoActual->getId(), $carrera);
           }    
        }

        return $this->render('ItsurAeiBundle:Aspirante:list.html.twig',array(
            'periodo'=>$periodoActual,
            'aspirantes'=> $aspirantes,
            'noAspirantes'=>count($aspirantes),
            'carrera'=>$carrera,
        ));

    }
    
    /**
     * @Route("/sucess", name="aspirante_sucess")
     * @Template()
     */
    public function sucessAction()
    {

        return new Response('Sucess');
    }

    /**
     * @Route("/{ficha}/areas", name="aspirante_areas")
     * @Template()
     */
    public function areasAspiranteAction($ficha, Request $request)
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

        $aspirante = $this->getDoctrine()->getRepository('ItsurAeiBundle:Aspirante')
            ->findByPeriodoAndFichaWithHoja($periodoActual->getId(), $ficha);

        //PROMEDIOS Areas
        $promediosAreas = $this->getDoctrine()->getRepository('ItsurAeiBundle:AreaEvaluable')
            ->avegareAreasByPeriodo($periodoActual->getId());
            
         $promediosAreas = Utilerias::procesarResultadoFuncionResumen($promediosAreas,'area', 'promedio');


        //Calificacion promedio
        $calificacionPromedio = $this->getDoctrine()->getRepository('ItsurAeiBundle:HojaRespuestas')
            ->averageCalificacionByPeriodo($periodoActual->getId());

         //Calificacion diagnostico promedio
        $diagnosticoPromedio = $this->getDoctrine()->getRepository('ItsurAeiBundle:HojaRespuestas')
            ->averageCalificacionDiagnosticoByPeriodo($periodoActual->getId());


        //Calificacion promedio
        $seleccionPromedio = $this->getDoctrine()->getRepository('ItsurAeiBundle:HojaRespuestas')
            ->averageCalificacionSeleccionByPeriodo($periodoActual->getId());
   

       

        if($aspirante)
        {
            return $this->render('ItsurAeiBundle:Aspirante:areasaspirante.html.twig',
            array('aspirante'=> $aspirante,
               'periodo'=>$periodoActual,
               'promedioCalificaccion'=>$calificacionPromedio[0][1],
               'diagnosticoCalificaccion'=>$diagnosticoPromedio[0][1],
               'seleccionCalificaccion'=>$seleccionPromedio[0][1],
               'promediosAreas'=>$promediosAreas,
            ));
        }else{
                return $this->render('ItsurAeiBundle:Administracion:aspirantenoencontrado.html.twig',
                    array('ficha'=> $ficha,
                         'periodo'=>$periodoActual,
                    ));
        }

        return $this->render('ItsurAeiBundle:Administracion:solicitarficha.html.twig',
        array(
            'form'=> $form->createView(),
            'periodoActual'=>$periodo,
            'reporte'=>1,
        ));
    }
    
     /**
     * @Route("/{ficha}/temas", name="aspirante_temas")
     * @Template()
     */
    public function temasAspiranteAction($ficha, Request $request)
    {
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());

            //$periodo = $this->container->getParameter('periodo.actual');
            $aspirante = $this->getDoctrine()->getRepository('ItsurAeiBundle:Aspirante')
            ->findByPeriodoAndFichaWithHoja($periodoActual->getId(), $ficha);


            //Promedios Temas
            $promediosTemas = $this->getDoctrine()->getRepository('ItsurAeiBundle:TemaEvaluable')
            ->avegareTemasByPeriodo($periodoActual->getId());

            $promediosTemas = Utilerias::procesarResultadoFuncionResumen($promediosTemas,'tema', 'promedio');

            if($aspirante)
            {
                  return $this->render('ItsurAeiBundle:Aspirante:temasaspirante.html.twig',
                    array('aspirante'=> $aspirante,
                         'periodo'=>$periodoActual,
                         'promediosTemas'=>$promediosTemas,
                         //'prueba'=>$promediosTemas[0]['tema'],
                    ));
            }else
            {
                return $this->render('ItsurAeiBundle:Administracion:aspirantenoencontrado.html.twig',
                    array('ficha'=> $ficha,
                         'periodo'=>$periodoActual,
                    ));
            }


        return $this->render('ItsurAeiBundle:Administracion:solicitarficha.html.twig',
        array(
            'form'=> $form->createView(),
            'periodo'=>$periodoActual,
            'reporte'=>2,
        ));
    }
}
















