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
 * @Route("/admin/area")
 * @Secure(roles="ROLE_ADMIN")
 */
class AreaController extends Controller
{

     /**
     * @Route("/{manual}/list", name="area_list")
     * @Template()
     */
    public function listAction($manual)
    {
        $repository = $this->getDoctrine()->getRepository('ItsurAeiBundle:Area');
        $areas =  $repository->findByManual($manual);

        return $this->render('ItsurAeiBundle:Area:list.html.twig',array(
        'areas'=> $areas,
        'noAreas'=>count($areas),
        ));

    }
}
















