<?php

namespace Itsur\AeiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Itsur\AeiBundle\Form\ConfiguracionType;
use Itsur\AeiBundle\Entity\Utilerias;


/**
 * @Route("/admin/configuracion")
 * @Secure(roles="ROLE_ADMIN")
 */
class ParametroController extends Controller
{

    /**
     * @Route("/mostrar", name="configuracion_mostrar")
     * @Template()
     */
    public function showAction(Request $request)
    {
        $parametros = $this->getDoctrine()->getRepository('ItsurAeiBundle:Parametro')->findAll();
        return array('parametros'=>$parametros);
    }


    /**
     * @Route("/cambiar", name="configuracion_cambiar")
     * @Template()
     */
    public function cambiarAction(Request $request)
    {
        $periodos = $this->getDoctrine()->getRepository('ItsurAeiBundle:Periodo')->findAll();
        $manuales = $this->getDoctrine()->getRepository('ItsurAeiBundle:Manual')->findAll();

        $periodo =  Utilerias::periodoActual($this->getDoctrine());
        $manual =  Utilerias::manualActual($this->getDoctrine());

        $defaultData = array(
            'periodo' => $periodo->getId(),
            'manual' => $manual->getClave(),
        );

        $formBuilder = new ConfiguracionType();
        $formBuilder->setPeriodos($periodos);
        $formBuilder->setManuales($manuales);
        $formBuilder->setManualActual($manual);
        $formBuilder->setPeriodoActual($periodo);
        $form = $this->createForm($formBuilder, $defaultData);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                //Guardar las nuevas configuraciones
                $data = $form->getData();
                $nuevoPeriodo = $data['periodo'];
                $nuevoManual = $data['manual'];
                
                $parametroPeriodo = $this->getDoctrine()->getRepository('ItsurAeiBundle:Parametro')->findOneByNombre('periodo.actual');
                $parametroManual = $this->getDoctrine()->getRepository('ItsurAeiBundle:Parametro')->findOneByNombre('manual.actual');
               
                $parametroPeriodo->setValor($nuevoPeriodo);
                $parametroManual->setValor($nuevoManual);

                $em = $this->getDoctrine()->getEntityManager();
                $em->merge($parametroPeriodo);
                $em->merge($parametroManual);
                $em->flush();

                return $this->redirect($this->generateUrl('admin_index'));
            }
        }
        return array('form'=>$form->createView());
    }

    
}








