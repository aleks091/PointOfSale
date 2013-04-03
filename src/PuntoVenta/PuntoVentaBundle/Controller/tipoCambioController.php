<?php

namespace PuntoVenta\PuntoVentaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PuntoVenta\PuntoVentaBundle\Entity\TipoCambio;
use PuntoVenta\PuntoVentaBundle\Form\tipoCambioType;

/**
 * tipoCambio controller.
 *
 */
class tipoCambioController extends Controller
{
    /**
     * Lists all tipoCambio entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PuntoVentaBundle:TipoCambio')->findAllOrderByFechaAgregado();

        return $this->render('PuntoVentaBundle:tipoCambio:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new tipoCambio entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new TipoCambio();
        $form = $this->createForm(new tipoCambioType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipocambio'));
        }

        return $this->render('PuntoVentaBundle:tipoCambio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new tipoCambio entity.
     *
     */
    public function newAction()
    {
        $entity = new TipoCambio();
        $form   = $this->createForm(new tipoCambioType(), $entity);
        $em = $this->getDoctrine()->getManager();
        $latestTipoCambio = $em->getRepository('PuntoVentaBundle:TipoCambio')->findLatest();


        return $this->render('PuntoVentaBundle:tipoCambio:new.html.twig', array(
            'latest' => $latestTipoCambio,
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tipoCambio entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PuntoVentaBundle:TipoCambio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find tipoCambio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PuntoVentaBundle:tipoCambio:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing tipoCambio entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PuntoVentaBundle:TipoCambio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find tipoCambio entity.');
        }

        $editForm = $this->createForm(new tipoCambioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PuntoVentaBundle:tipoCambio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing tipoCambio entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PuntoVentaBundle:TipoCambio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find tipoCambio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new tipoCambioType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipocambio_edit', array('id' => $id)));
        }

        return $this->render('PuntoVentaBundle:tipoCambio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tipoCambio entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PuntoVentaBundle:TipoCambio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find tipoCambio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipocambio'));
    }

    /**
     * Creates a form to delete a tipoCambio entity by id.
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
