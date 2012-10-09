<?php

namespace Itsur\AeiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Itsur\AeiBundle\Entity\Periodo;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
* @Route("/admin")
*/
class AdministracionController extends Controller
{
    /**
     * @Route("/", name="admin_index")
     * @Template()
     */
    public function indexAction()
    {

        return $this->render('ItsurAeiBundle:Administracion:index.html.twig');
    }
    
    /**
     * @Route("/listado", name="admin_listado_aspirantes")
     * @Template()
     */
    public function listadoAspirantesAction()
    {
        $id = $this->container->getParameter('periodo.actual');
        
        $periodo = $this->getDoctrine()->getRepository('ItsurAeiBundle:Periodo')
        ->find($id);
        
        $aspirantes = $this->getDoctrine()->getRepository('ItsurAeiBundle:Aspirante')
        ->findAllByPeriodo($periodo->getId());

        return $this->render('ItsurAeiBundle:Administracion:listadoaspirantes.html.twig', array(
            'aspirantes'=> $aspirantes,
            'periodo'=>$periodo,
        ));
    }
    
    /**
     * @Route("/listadocalificaciones", name="admin_calificaciones_aspirantes")
     * @Template()
     */
    public function calificacionesAspirantesAction()
    {
        $id = $this->container->getParameter('periodo.actual');

        $periodo = $this->getDoctrine()->getRepository('ItsurAeiBundle:Periodo')
        ->find($id);

        $aspirantes = $this->getDoctrine()->getRepository('ItsurAeiBundle:Aspirante')
        ->findAllByPeriodoWithHoja($periodo->getId());

        return $this->render('ItsurAeiBundle:Administracion:calificacionesaspirantes.html.twig', array(
            'aspirantes'=> $aspirantes,
            'periodo'=>$periodo,
        ));
    }
    
    /**
     * @Route("/areasaspirante", name="admin_areas_aspirante")
     * @Template()
     */
    public function areasAspiranteAction(Request $request)
    {
        $id = $this->container->getParameter('periodo.actual');

        $periodo = $this->getDoctrine()->getRepository('ItsurAeiBundle:Periodo')
        ->find($id);

        $form = $this->createFormBuilder()
        ->add('ficha', 'integer')
        ->getForm();

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            $data = $form->getData();
            $ficha =  $data['ficha'];

            //$periodo = $this->container->getParameter('periodo.actual');
            $aspirante = $this->getDoctrine()->getRepository('ItsurAeiBundle:Aspirante')
            ->findByPeriodoAndFichaWithHoja($periodo->getId(), $ficha);

            if($aspirante)
            {
                  return $this->render('ItsurAeiBundle:Administracion:areasaspirante.html.twig',
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

        }

        return $this->render('ItsurAeiBundle:Administracion:solicitarficha.html.twig',
        array(
            'form'=> $form->createView(),
            'periodo'=>$periodo,
            'reporte'=>1,
        ));
    }
    
    
    /**
     * @Route("/temaspirante", name="admin_temas_aspirante")
     * @Template()
     */
    public function temasAspiranteAction(Request $request)
    {
        $id = $this->container->getParameter('periodo.actual');

        $periodo = $this->getDoctrine()->getRepository('ItsurAeiBundle:Periodo')
        ->find($id);

        $form = $this->createFormBuilder()
        ->add('ficha', 'integer')
        ->getForm();

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            $data = $form->getData();
            $ficha =  $data['ficha'];

            //$periodo = $this->container->getParameter('periodo.actual');
            $aspirante = $this->getDoctrine()->getRepository('ItsurAeiBundle:Aspirante')
            ->findByPeriodoAndFichaWithHoja($periodo->getId(), $ficha);

            if($aspirante)
            {
                  return $this->render('ItsurAeiBundle:Administracion:temasaspirante.html.twig',
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

        }

        return $this->render('ItsurAeiBundle:Administracion:solicitarficha.html.twig',
        array(
            'form'=> $form->createView(),
            'periodo'=>$periodo,
            'reporte'=>2,
        ));
    }
}
















