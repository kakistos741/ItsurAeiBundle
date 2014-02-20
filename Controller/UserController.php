<?php

namespace Itsur\AeiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Itsur\AeiBundle\Entity\User;
use Itsur\AeiBundle\Form\UserType;

/**
 * @Route("/admin/usuario")
 * @Secure(roles="ROLE_ADMIN")
 */
class UserController extends Controller
{

    /**
     * @Route("/new", name="user_new")
     * @Template()
     */
    public function newAction(Request $request)
    {
        $user = new User();
       
        $form = $this->createForm(new UserType(), $user);
            
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();

                //$factory = $this->get('security.encoder_factory');
                //$encoder = $factory->getEncoder($user);
                //$password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
                //$user->setPassword($password);
                
                $em->persist($user);
                $em->flush();
                return $this->redirect($this->generateUrl('usuario/list'));
            }
            
        }

        return $this->render('ItsurAeiBundle:User:new.html.twig',array(
            'form'=> $form->createView(),
        ));
    }
    
    /**
     * @Route("/sucess", name="user_sucess")
     * @Template()
     */
    public function sucessAction()
    {

        return new Response('Sucess');
    }

    /**
     * @Route("/list", name="user_list")
     * @Template()
     */
    public function listAction()
    {
        $repository = $this->getDoctrine()->getRepository('ItsurAeiBundle:User');
        $users =  $repository->findAll();

        return array(
            'users'=> $users,
            'noUsers'=>count($users),
        );
    }

    /**
     * @Route("/update/{id}", name="user_update")
     * @Template()
     */
    public function updateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository('ItsurAeiBundle:User')->find($id);
        
        if(!$user){
            throw $this->createNotFoundException('No user found for id'.$id);
        }
        
        $form = $this->createForm(new UserType(), $user);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em->flush();
                return $this->redirect($this->generateUrl('user_sucess'));
            }

        }

        return $this->render('ItsurAeiBundle:User:update.html.twig',array(
        'form'=> $form->createView(),
        ));
    }

    /**
     * @Route("/delete/{id}", name="user_delete")
     * @Template()
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository('ItsurAeiBundle:User')->find($id);
        
        if(!$user){
            throw $this->createNotFoundException('No user found for id'.$id);
        }
        $em->remove($user);
        $em->flush();
        return new Response('Usuario eliminado'. $id);
    }
}
















