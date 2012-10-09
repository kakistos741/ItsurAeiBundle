<?php

namespace Itsur\AeiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Itsur\AeiBundle\Entity\Periodo;
use Itsur\AeiBundle\Form\PeriodoType;

/**
 * @Route("/admin/periodo")
 * @Secure(roles="ROLE_ADMIN")
 */
class PeriodoController extends Controller
{

    /**
     * @Route("/new", name="periodo_new")
     * @Template()
     */
    public function newAction(Request $request)
    {
        $periodo = new Periodo();
        $periodo->setSemestre('Enero - Junio');
        $periodo->setAnio('2012');

        $form = $this->createForm(new PeriodoType(), $periodo);
            
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($periodo );
                $em->flush();
                return $this->redirect($this->generateUrl('periodo_sucess'));
            }
            
        }

        return $this->render('ItsurAeiBundle:Periodo:new.html.twig',array(
        'form'=> $form->createView(),
        ));
    }
    
    /**
     * @Route("/sucess", name="periodo_sucess")
     * @Template()
     */
    public function sucessAction()
    {

        return new Response('Sucess');
    }
    
    
    /**
     * @Route("/show/{id}", name="periodo_show")
     * @Template()
     */
    public function showAction($id)
    {
        $periodo = $this->getDoctrine()->getRepository('ItsurAeiBundle:Periodo')
        ->find($id);

        return new Response('Periodo semestre '. $periodo->getSemestre());
    }

    /**
     * @Route("/list", name="periodo_list")
     * @Template()
     */
    public function listAction()
    {
        $repository = $this->getDoctrine()->getRepository('ItsurAeiBundle:Periodo');

        $periodos =  $repository->findAll();

        return new Response($periodo.'Periodo semestre '. $periodos);
    }

    /**
     * @Route("/update/{id}", name="periodo_update")
     * @Template()
     */
    public function updateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $periodo = $em->getRepository('ItsurAeiBundle:Periodo')->find($id);
        
        if(!$periodo){
            throw $this->createNotFoundException('No periodo found for id'.$id);
        }
        
        $form = $this->createForm(new PeriodoType(), $periodo);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em->flush();
                return $this->redirect($this->generateUrl('periodo_sucess'));
            }

        }

        return $this->render('ItsurAeiBundle:Periodo:update.html.twig',array(
        'form'=> $form->createView(),
        ));
    }

    /**
     * @Route("/delete/{id}", name="periodo_delete")
     * @Template()
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $periodo = $em->getRepository('ItsurAeiBundle:Periodo')->find($id);
        
        if(!$periodo){
            throw $this->createNotFoundException('No periodo found for id'.$id);
        }
        $em->remove($periodo);
        $em->flush();
        return new Response('Periodo eliminado'. $id);
    }
    
}
















