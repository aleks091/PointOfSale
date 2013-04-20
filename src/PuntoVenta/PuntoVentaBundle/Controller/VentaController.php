<?php

namespace PuntoVenta\PuntoVentaBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PuntoVenta\PuntoVentaBundle\Entity\Venta;
use PuntoVenta\PuntoVentaBundle\Form\VentaType;

use PuntoVenta\PuntoVentaBundle\Entity\VentaUnitaria;
use PuntoVenta\PuntoVentaBundle\Form\VentaUnitariaType;

use PuntoVenta\PuntoVentaBundle\Entity\Cliente;
use PuntoVenta\PuntoVentaBundle\Form\ClienteType;

use  PuntoVenta\PuntoVentaBundle\Resources\viewModels\CategoriaViewModel;
use  Doctrine\Common\Util\Debug;


/**
 * Venta controller.
 *
 */
class VentaController extends Controller
{
    /**
     * Lists all Venta entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PuntoVentaBundle:Venta')->findAll();

        return $this->render('PuntoVentaBundle:Venta:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Venta entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Venta();
        $form = $this->createForm(new VentaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('venta_show', array('id' => $entity->getId())));
        }

        return $this->redirect($this->generateUrl('venta_new'));
    }

    /**
     * Displays a form to create a new Venta entity.
     *
     */
    public function newAction()
    {
        $venta = new Venta();
        $ventaUnitaria = new VentaUnitaria();
        $em = $this->getDoctrine()->getManager();

        $producto = $em->getRepository('PuntoVentaBundle:Producto')
            ->getFirstProductoOfFirstCategory();
        $iva = $em->getRepository('PuntoVentaBundle:IVA')->findLatest();
        $tipoCambio = $em->getRepository('PuntoVentaBundle:TipoCambio')->findLatest();


        $tipoCambioValue = $tipoCambio->getTipoCambio();
        $cantidadProducto = 1;
        $importe = $producto->getPrecioUnitario() * $cantidadProducto;
        $porcentajeIva =  1 + $iva->getIva() / 100;
        $cantidadIva = $importe * $iva->getIva() / 100;
        $ventaTotal = $importe * $porcentajeIva;

        $ventaUnitaria->setCantidadProducto($cantidadProducto);
        $ventaUnitaria->setProductoId($producto->getId());
        $ventaUnitaria->setImporte($importe);
        $ventaUnitaria->setPrecioUnitario($producto->getPrecioUnitario());


        $venta->getVentasUnitarias()->add($ventaUnitaria);
        $venta->setSubtotal($importe);
        $venta->setTotal($ventaTotal);

        $optionsForVenta = array( 'attr' =>
        array('cantidadIva' => $cantidadIva, 'tipoCambio' => $tipoCambioValue));

        $form = $this->createForm(new VentaType(), $venta, $optionsForVenta);

        return $this->render('PuntoVentaBundle:Venta:new.html.twig', array(
            'entity' => $venta,
            'venta'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Venta entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PuntoVentaBundle:Venta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Venta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PuntoVentaBundle:Venta:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(), ));
    }

    /**
     * Displays a form to edit an existing Venta entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PuntoVentaBundle:Venta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Venta entity.');
        }

        $editForm = $this->createForm(new VentaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PuntoVentaBundle:Venta:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Venta entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PuntoVentaBundle:Venta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Venta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new VentaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('venta_edit', array('id' => $id)));
        }

        return $this->render('PuntoVentaBundle:Venta:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Venta entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PuntoVentaBundle:Venta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Venta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('venta'));
    }

    /**
     * Creates a form to delete a Venta entity by id.
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
