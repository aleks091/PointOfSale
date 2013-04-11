<?php

namespace PuntoVenta\PuntoVentaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PuntoVenta\PuntoVentaBundle\Entity\DescripcionEspecificacion;
use PuntoVenta\PuntoVentaBundle\Form\DescripcionEspecificacionType;

/**
 * DescripcionEspecificacion controller.
 *
 */
class DescripcionEspecificacionController extends Controller
{
    /**
     * Lists all DescripcionEspecificacion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PuntoVentaBundle:DescripcionEspecificacion')->findAll();

        return $this->render('PuntoVentaBundle:DescripcionEspecificacion:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new DescripcionEspecificacion entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new DescripcionEspecificacion();
        $form = $this->createForm(new DescripcionEspecificacionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('descripcionespecificacion_show', array('id' => $entity->getId())));
        }

        return $this->render('PuntoVentaBundle:DescripcionEspecificacion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new DescripcionEspecificacion entity.
     *
     */
    public function newAction($id)
    {
        $entity = new DescripcionEspecificacion();

        if($id != 0){
            $em = $this->getDoctrine()->getManager();
            $especificacion = $em->getRepository('PuntoVentaBundle:Especificacion')->findOneById($id);
            $entity->setEspecificacion($especificacion);
        }

        $form   = $this->createForm(new DescripcionEspecificacionType(), $entity);

        return $this->render('PuntoVentaBundle:DescripcionEspecificacion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a DescripcionEspecificacion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PuntoVentaBundle:DescripcionEspecificacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DescripcionEspecificacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PuntoVentaBundle:DescripcionEspecificacion:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing DescripcionEspecificacion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PuntoVentaBundle:DescripcionEspecificacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DescripcionEspecificacion entity.');
        }

        $editForm = $this->createForm(new DescripcionEspecificacionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PuntoVentaBundle:DescripcionEspecificacion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing DescripcionEspecificacion entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PuntoVentaBundle:DescripcionEspecificacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DescripcionEspecificacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DescripcionEspecificacionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('descripcionespecificacion_edit', array('id' => $id)));
        }

        return $this->render('PuntoVentaBundle:DescripcionEspecificacion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a DescripcionEspecificacion entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PuntoVentaBundle:DescripcionEspecificacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find DescripcionEspecificacion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('descripcionespecificacion'));
    }

    /**
     * Creates a form to delete a DescripcionEspecificacion entity by id.
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
