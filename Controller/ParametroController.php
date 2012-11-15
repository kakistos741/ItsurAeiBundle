<?php

namespace Itsur\AeiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/admin/parametro")
 * @Secure(roles="ROLE_ADMIN")
 */
class ParametroController extends Controller
{

    /**
     * @Route("/list", name="periodo_list")
     * @Template()
     */
    public function listAction()
    {
        $repository = $this->getDoctrine()->getRepository('ItsurAeiBundle:Parametro');
        $parametros =  $repository->findAll();

        return array('parametros'=>$parametros);
    }

    
}








