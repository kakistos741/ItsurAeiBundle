<?php

namespace Itsur\AeiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Itsur\AeiBundle\Entity\Seccion;
use Itsur\AeiBundle\Form\SeccionType;

/**
 * Seccion controller.
 *
 * @Route("/admin/seccion")
 * @Secure(roles="ROLE_ADMIN")
 */
class SeccionController extends Controller
{
    /**
     * Lists all Seccion entities.
     *
     * @Route("/", name="seccion")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ItsurAeiBundle:Seccion')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Seccion entity.
     *
     * @Route("/{id}/show", name="seccion_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ItsurAeiBundle:Seccion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seccion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Seccion entity.
     *
     * @Route("/news", name="seccion_news")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Seccion();
        $form   = $this->createForm(new SeccionType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Seccion entity.
     *
     * @Route("/create", name="seccion_create")
     * @Method("post")
     * @Template("ItsurAeiBundle:Seccion:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Seccion();
        $request = $this->getRequest();
        $form    = $this->createForm(new SeccionType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('seccion_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Seccion entity.
     *
     * @Route("/{id}/edit", name="seccion_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ItsurAeiBundle:Seccion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seccion entity.');
        }

        $editForm = $this->createForm(new SeccionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Seccion entity.
     *
     * @Route("/{id}/update", name="seccion_update")
     * @Method("post")
     * @Template("ItsurAeiBundle:Seccion:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ItsurAeiBundle:Seccion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seccion entity.');
        }

        $editForm   = $this->createForm(new SeccionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('seccion_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Seccion entity.
     *
     * @Route("/{id}/delete", name="seccion_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ItsurAeiBundle:Seccion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Seccion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('seccion'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
