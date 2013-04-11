<?php

namespace PuntoVenta\PuntoVentaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PuntoVenta\PuntoVentaBundle\Entity\Especificacion;
use PuntoVenta\PuntoVentaBundle\Form\EspecificacionType;
use PuntoVenta\PuntoVentaBundle\Form\CategoriaType;
use PuntoVenta\PuntoVentaBundle\Entity\Categoria;
use  PuntoVenta\PuntoVentaBundle\Resources\viewModels\CategoriaViewModel;
/**
 * Especificacion controller.
 *
 */
class EspecificacionController extends Controller
{
    /**
     * Lists all Especificacion entities.
     *
     */
    public function indexAction($id)
    {        
        $em = $this->getDoctrine()->getManager();

        $categorias = $em->getRepository('PuntoVentaBundle:Categoria')->findAll();
        
        $entitiesCategoiaId = 0;

        if($id == 0)
            $entities = $em->getRepository('PuntoVentaBundle:Especificacion')->findByCategoriaId($categorias[0]->getId());
        else{
            $entities = $em->getRepository('PuntoVentaBundle:Especificacion')->findByCategoriaId($id);
            $entitiesCategoiaId = $entities[0]->getCategoria()->getId();            
        }

        $categoriasVm = new CategoriaViewModel();
        $categoriasSelect = $categoriasVm->getCategoriaSelection($categorias , $entitiesCategoiaId);

        return $this->render('PuntoVentaBundle:Especificacion:index.html.twig', array(
            'categorias' => $categoriasSelect,
            'categoriaNombre' => $entities[0]->getCategoria()->getNombre(),
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Especificacion entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Especificacion();
        $form = $this->createForm(new EspecificacionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('especificacion_show', array('id' => $entity->getId())));
        }

        return $this->render('PuntoVentaBundle:Especificacion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Especificacion entity.
     *
     */
    public function newAction($id)
    {
        $entity = new Especificacion();

        if($id != 0){
            $em = $this->getDoctrine()->getManager();
            $categoria = $em->getRepository('PuntoVentaBundle:Categoria')->findOneById($id);
            $entity->setCategoria($categoria);
        }

        $form   = $this->createForm(new EspecificacionType(), $entity);

        return $this->render('PuntoVentaBundle:Especificacion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Especificacion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PuntoVentaBundle:Especificacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Especificacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PuntoVentaBundle:Especificacion:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Especificacion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PuntoVentaBundle:Especificacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Especificacion entity.');
        }

        $editForm = $this->createForm(new EspecificacionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PuntoVentaBundle:Especificacion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Especificacion entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PuntoVentaBundle:Especificacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Especificacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EspecificacionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('especificacion_edit', array('id' => $id)));
        }

        return $this->render('PuntoVentaBundle:Especificacion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Especificacion entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PuntoVentaBundle:Especificacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Especificacion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('especificacion'));
    }

    /**
     * Creates a form to delete a Especificacion entity by id.
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
