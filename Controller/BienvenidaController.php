<?php

namespace Itsur\AeiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Itsur\AeiBundle\Entity\Periodo;
use Symfony\Component\HttpFoundation\Response;

class BienvenidaController extends Controller
{
    /**
     * @Route("/", name="aei_bienvenida")
     * @Template()
     */
    public function indexAction()
    {
        return array();

    }
}
