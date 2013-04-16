<?php

namespace PuntoVenta\PuntoVentaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PuntoVenta\PuntoVentaBundle\Entity\VentaUnitaria;
use PuntoVenta\PuntoVentaBundle\Form\VentaUnitariaType;

/**
 * VentaUnitaria controller.
 *
 */
class VentaUnitariaController extends Controller
{
    /**
     * Lists all VentaUnitaria entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PuntoVentaBundle:VentaUnitaria')->findAll();

        return $this->render('PuntoVentaBundle:VentaUnitaria:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new VentaUnitaria entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new VentaUnitaria();
        $form = $this->createForm(new VentaUnitariaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ventaunitaria_show', array('id' => $entity->getId())));
        }

        return $this->render('PuntoVentaBundle:VentaUnitaria:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new VentaUnitaria entity.
     *
     */
    public function newAction()
    {
        $em = $this->getDoctrine()->getManager();
        $producto = $em->getRepository('PuntoVentaBundle:Producto')
            ->getFirstProductoOfFirstCategory();
        $entity = new VentaUnitaria();

        $cantidadProducto = 1;
        $importe = $producto->getPrecioUnitario() * $cantidadProducto;

        $entity->setCantidadProducto($cantidadProducto);
        $entity->setProductoId($producto->getId());
        $entity->setImporte($importe);
        $entity->setPrecioUnitario($producto->getPrecioUnitario());

        $form   = $this->createForm(new VentaUnitariaType(), $entity);

        return $this->render('PuntoVentaBundle:VentaUnitaria:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a VentaUnitaria entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PuntoVentaBundle:VentaUnitaria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VentaUnitaria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PuntoVentaBundle:VentaUnitaria:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView()));
    }

    /**
     * Displays a form to edit an existing VentaUnitaria entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
		$producto = $em->getRepository('PuntoVentaBundle:Producto')
                        ->getFirstProductoOfFirstCategory();
        
        $ventaUnitaria = new VentaUnitaria();

        if($producto->getId() != null)
            $ventaUnitaria->setProducto($producto);

        $ventaUnitariaOptions = array('attr'=>array( 
        		'precioUnitario' => $producto->getPreciounitario(),
        		'cantidadProducto' => 1));
        
        $editForm = $this->createForm(new VentaUnitariaType(), $ventaUnitaria, $ventaUnitariaOptions);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PuntoVentaBundle:VentaUnitaria:edit.html.twig', array(
            'entity'      => $ventaUnitaria,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing VentaUnitaria entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PuntoVentaBundle:VentaUnitaria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VentaUnitaria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new VentaUnitariaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ventaunitaria_edit', array('id' => $id)));
        }

        return $this->render('PuntoVentaBundle:VentaUnitaria:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a VentaUnitaria entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PuntoVentaBundle:VentaUnitaria')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find VentaUnitaria entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ventaunitaria'));
    }

    /**
     * Creates a form to delete a VentaUnitaria entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
