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
 * @Route("/admin/manual")
 * @Secure(roles="ROLE_ADMIN")
 */
class ManualController extends Controller
{

    
    /**
     * @Route("/show/{clave}", name="manual_show")
     * @Template()
     */
    public function showAction($clave)
    {
        
        $repository = $this->getDoctrine()->getRepository('ItsurAeiBundle:Manual');

        $manual =  $repository->findOneByClave($clave);

        return array(
                    'manual'=> $manual,
                );
    }


    /**
     * @Route("/actual", name="manual_actual")
     * @Template()
     */
    public function actualAction()
    {
        $manualActual = Utilerias::manualActual($this->getDoctrine());

        return $this->render('ItsurAeiBundle:Manual:show.html.twig',array(
        'manual'=> $manual,
        ));
    }

     /**
     * @Route("/list", name="manual_list")
     * @Template()
     */
    public function listAction()
    {
        $repository = $this->getDoctrine()->getRepository('ItsurAeiBundle:Manual');
        $manuales =  $repository->findAll();

        return $this->render('ItsurAeiBundle:Manual:list.html.twig',array(
        'manuales'=> $manuales,
        'noManuales'=>count($manuales),
        ));

    }


     /**
     * @Route("/grupospreguntas/{temaid}", name="manual_gruposPreguntas")
     * @Template()
     */
    public function gruposPreguntasAction($temaid)
    {
        $repository = $this->getDoctrine()->getRepository('ItsurAeiBundle:Tema');
        $tema =  $repository->findOneById($temaid);

        return array(
            'tema'=> $tema,
        );

    }
}
















