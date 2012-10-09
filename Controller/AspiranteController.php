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
 * @Route("/admin/aspirante")
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
     * @Route("/show/{ficha}", name="aspirante_show")
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
     * @Route("/list", name="aspirante_list")
     * @Template()
     */
    public function listAction()
    {
        $periodo = $this->container->getParameter('periodo.actual');
        $repository = $this->getDoctrine()->getRepository('ItsurAeiBundle:Periodo');

        $periodos =  $repository->findAll();

        return new Response($periodo.'Aspirantes '. $periodos);
    }
    
    /**
     * @Route("/sucess", name="aspirante_sucess")
     * @Template()
     */
    public function sucessAction()
    {

        return new Response('Sucess');
    }
    
    
}
















