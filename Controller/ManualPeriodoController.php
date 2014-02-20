<?php

namespace Itsur\AeiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Itsur\AeiBundle\Entity\Periodo;
use Itsur\AeiBundle\Entity\ManualPeriodo;

/**
 * @Route("/admin/manualperiodo")
 * @Secure(roles="ROLE_ADMIN")
 */
class ManualPeriodoController extends Controller
{

    
    /**
     * @Route("/show/{manual}", name="manual_periodo_show")
     * @Template()
     */
    public function showAction($manual)
    {
        
        $repository = $this->getDoctrine()->getRepository('ItsurAeiBundle:ManualPeriodo');

        $manualPeriodo =  $repository->findOneById($manual);

        return array(
            'manualperiodo' => $manualPeriodo,
        );
    }

    /**
     * @Route("/showArea/{area}", name="area_periodo_show")
     * @Template()
     */
    public function showAreaAction($area){
        $repository = $this->getDoctrine()->getRepository('ItsurAeiBundle:AreaPeriodo');

        $areaPeriodo =  $repository->findOneById($area);

        return array(
            'areaperiodo' => $areaPeriodo,
        );

    }

    /**
     * @Route("/seccionArea/{seccion}", name="seccion_periodo_show")
     * @Template()
     */
    public function showSeccionAction($seccion){
        $repository = $this->getDoctrine()->getRepository('ItsurAeiBundle:SeccionPeriodo');

        $seccionPeriodo =  $repository->findOneById($seccion);

        return array(
            'seccionperiodo' => $seccionPeriodo,
        );

    }


    /**
     * @Route("/temaArea/{tema}", name="tema_periodo_show")
     * @Template()
     */
    public function showTemaAction($tema){
        $repository = $this->getDoctrine()->getRepository('ItsurAeiBundle:TemaPeriodo');

        $temaPeriodo =  $repository->findOneById($tema);

        return array(
            'temaperiodo' => $temaPeriodo,
        );
    }

    /**
     * @Route("/grupoArea/{grupo}", name="grupo_periodo_show")
     * @Template()
     */
    public function showGrupoAction($grupo){
        $repository = $this->getDoctrine()->getRepository('ItsurAeiBundle:GrupoPeriodo');

        $grupoPeriodo =  $repository->findOneById($grupo);

        return array(
            'grupoperiodo' => $grupoPeriodo,
        );
    }

}
















