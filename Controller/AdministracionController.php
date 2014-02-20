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
use Itsur\AeiBundle\Entity\Utilerias;

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
        
        $periodoActual = Utilerias::periodoActual($this->getDoctrine());
        return $this->render('ItsurAeiBundle:Administracion:index.html.twig',array('periodo'=>$periodoActual));
    }

    
    /**
     * @Route("/login", name="_aei_security_login")
     * @Template()
     */
    public function loginAction()
    {
        if ($this->get('request')->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $this->get('request')->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $this->get('request')->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render(
            'ItsurAeiBundle:Security:login.html.twig', 
            array(
            'last_username' => $this->get('request')->getSession()->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
            )
        );
    }

    /**
     * @Route("/login_check", name="_aei_security_check")
     */
    public function securityCheckAction()
    {
        // The security layer will intercept this request
    }

    /**
     * @Route("/logout", name="_aei_security_logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }


    
}
















