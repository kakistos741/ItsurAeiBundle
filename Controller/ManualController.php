<?php

namespace Itsur\AeiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Itsur\AeiBundle\Entity\Periodo;
use Itsur\AeiBundle\Entity\Manual;
use Itsur\AeiBundle\Form\PeriodoType;
use Itsur\AeiBundle\Entity\Utilerias;
use Itsur\AeiBundle\Form\ManualType;

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
            'manual'=> $manualActual,
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
    

     /**
     *
     * @Route("/new", name="manual_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Manual();
        $form   = $this->createForm(new ManualType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Manual entity.
     *
     * @Route("/create", name="manual_create")
     * @Template("ItsurAeiBundle:Manual:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Manual();
        $request = $this->getRequest();
        $form    = $this->createForm(new ManualType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('manual_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Manual entity.
     *
     * @Route("/{id}/edit", name="manual_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ItsurAeiBundle:Manual')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Manual entity.');
        }

        $editForm = $this->createForm(new ManualType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Manual entity.
     *
     * @Route("/{id}/update", name="manual_update")
     * @Template("ItsurAeiBundle:Manual:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ItsurAeiBundle:Manual')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Manual entity.');
        }

        $editForm   = $this->createForm(new ManualType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('manual_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Manual entity.
     *
     * @Route("/{id}/delete", name="manual_delete")

     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ItsurAeiBundle:Manual')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Manual entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('manual'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
        
        
    
}
















