<?php

namespace PuntoVenta\PuntoVentaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PuntoVenta\PuntoVentaBundle\Entity\Cliente;
use PuntoVenta\PuntoVentaBundle\Form\ClienteType;

/**
 * Cliente controller.
 *
 */
class ClienteController extends Controller
{
    /**
     * Lists all Cliente entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PuntoVentaBundle:Cliente')->findAll();

        return $this->render('PuntoVentaBundle:Cliente:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Cliente entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Cliente();
        $form = $this->createForm(new ClienteType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cliente'));
        }

        return $this->render('PuntoVentaBundle:Cliente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Cliente entity.
     *
     */
    public function newAction()
    {
        $entity = new Cliente();
        $form   = $this->createForm(new ClienteType(), $entity);

        return $this->render('PuntoVentaBundle:Cliente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Cliente entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PuntoVentaBundle:Cliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cliente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PuntoVentaBundle:Cliente:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Cliente entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PuntoVentaBundle:Cliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cliente entity.');
        }

        $editForm = $this->createForm(new ClienteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PuntoVentaBundle:Cliente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Cliente entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PuntoVentaBundle:Cliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cliente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ClienteType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cliente'));
        }

        return $this->render('PuntoVentaBundle:Cliente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Cliente entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PuntoVentaBundle:Cliente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cliente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cliente'));
    }

    public function searchAction(Request $request){
        echo 'search';
        return $this->redirect($this->generateUrl('cliente'));
    }

    /**
     * Creates a form to delete a Cliente entity by id.
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
