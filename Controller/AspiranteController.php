<?php

namespace Itsur\AeiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Itsur\AeiBundle\Entity\Aspirante;
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
        $em = $this->getDoctrine()->getEntityManager();
        $id = $this->container->getParameter('periodo.actual');
        $periodo = $this->getDoctrine()->getRepository('ItsurAeiBundle:Periodo')->find($id);
        
        $aspirante = new Aspirante();
        $aspirante->setPeriodo($periodo);

        $form = $this->createForm(new AspiranteType(), $aspirante);
            
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {

                $em->persist($aspirante);
                $em->flush();
                return $this->redirect($this->generateUrl('aspirante_sucess'));
            }
            
        }

        return $this->render('ItsurAeiBundle:Aspirante:new.html.twig',array(
        'form'=> $form->createView(),
        'next'=> $next,
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
        $periodo = $this->container->getParameter('periodo.actual');
        $aspirante = $this->getDoctrine()->getRepository('ItsurAeiBundle:Aspirante')
        ->findByPeriodoAndFicha($periodo, $ficha);

        if(!$aspirante){
            throw $this->createNotFoundException('No se encontró el aspirante con la ficha '.$ficha);
        }
        return $this->render('ItsurAeiBundle:Aspirante:show.html.twig',array(
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
        $periodoActual = $this->container->getParameter('periodo.actual');
        $repository = $this->getDoctrine()->getRepository('ItsurAeiBundle:Aspirante');

        if($order == "asc"){
           if($carrera == "TODAS"){
               $aspirantes =  $repository->findAllOrderedNameByPeriodo($periodoActual);
           }else{
               $aspirantes = $repository->findAllOrderedNameByPeriodoAndCarrera($periodoActual, $carrera);
           }  
        }elseif($order == "desc"){
           if($carrera == "TODAS"){
               $aspirantes =  $repository->findAllOrderedNameDescByPeriodo($periodoActual);
           }else{
               $aspirantes = $repository->findAllOrderedNameDescByPeriodoAndCarrera($periodoActual, $carrera);
           }  
        }else{
           if($carrera == "TODAS"){
               $aspirantes =  $repository->findAllByPeriodo($periodoActual);
           }else{
               $aspirantes =  $repository->findAllByPeriodoAndCarrera($periodoActual, $carrera);
           }    
        }

        return $this->render('ItsurAeiBundle:Aspirante:list.html.twig',array(
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
        $id = $this->container->getParameter('periodo.actual');

        $periodo = $this->getDoctrine()->getRepository('ItsurAeiBundle:Periodo')
        ->find($id);

        $aspirante = $this->getDoctrine()->getRepository('ItsurAeiBundle:Aspirante')
            ->findByPeriodoAndFichaWithHoja($periodo->getId(), $ficha);

        if($aspirante)
        {
            return $this->render('ItsurAeiBundle:Aspirante:areasaspirante.html.twig',
            array('aspirante'=> $aspirante,
               'periodo'=>$periodo,
            ));
        }else{
                return $this->render('ItsurAeiBundle:Administracion:aspirantenoencontrado.html.twig',
                    array('ficha'=> $ficha,
                         'periodo'=>$periodo,
                    ));
        }

        return $this->render('ItsurAeiBundle:Administracion:solicitarficha.html.twig',
        array(
            'form'=> $form->createView(),
            'periodo'=>$periodo,
            'reporte'=>1,
        ));
    }
    
     /**
     * @Route("/{ficha}/temas", name="aspirante_temas")
     * @Template()
     */
    public function temasAspiranteAction($ficha, Request $request)
    {
        $id = $this->container->getParameter('periodo.actual');

        $periodo = $this->getDoctrine()->getRepository('ItsurAeiBundle:Periodo')
        ->find($id);

            //$periodo = $this->container->getParameter('periodo.actual');
            $aspirante = $this->getDoctrine()->getRepository('ItsurAeiBundle:Aspirante')
            ->findByPeriodoAndFichaWithHoja($periodo->getId(), $ficha);

            if($aspirante)
            {
                  return $this->render('ItsurAeiBundle:Aspirante:temasaspirante.html.twig',
                    array('aspirante'=> $aspirante,
                         'periodo'=>$periodo,
                    ));
            }else
            {
                return $this->render('ItsurAeiBundle:Administracion:aspirantenoencontrado.html.twig',
                    array('ficha'=> $ficha,
                         'periodo'=>$periodo,
                    ));
            }


        return $this->render('ItsurAeiBundle:Administracion:solicitarficha.html.twig',
        array(
            'form'=> $form->createView(),
            'periodo'=>$periodo,
            'reporte'=>2,
        ));
    }
}
















