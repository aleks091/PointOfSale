<?php

namespace PuntoVenta\PuntoVentaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PuntoVenta\PuntoVentaBundle\Entity\iva;
use PuntoVenta\PuntoVentaBundle\Form\ivaType;

/**
 * iva controller.
 *
 */
class ivaController extends Controller
{
    /**
     * Lists all iva entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PuntoVentaBundle:iva')->findAll();

        return $this->render('PuntoVentaBundle:iva:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new iva entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new iva();
        $form = $this->createForm(new ivaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('iva_show', array('id' => $entity->getId())));
        }

        return $this->render('PuntoVentaBundle:iva:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new iva entity.
     *
     */
    public function newAction()
    {
        $entity = new iva();
        $form   = $this->createForm(new ivaType(), $entity);

        return $this->render('PuntoVentaBundle:iva:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a iva entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PuntoVentaBundle:iva')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find iva entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PuntoVentaBundle:iva:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing iva entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PuntoVentaBundle:iva')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find iva entity.');
        }

        $editForm = $this->createForm(new ivaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PuntoVentaBundle:iva:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing iva entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PuntoVentaBundle:iva')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find iva entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ivaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('iva_edit', array('id' => $id)));
        }

        return $this->render('PuntoVentaBundle:iva:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a iva entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PuntoVentaBundle:iva')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find iva entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('iva'));
    }

    /**
     * Creates a form to delete a iva entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
