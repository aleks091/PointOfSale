<?php

namespace PuntoVenta\PuntoVentaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DescripcionEspecificacion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PuntoVenta\PuntoVentaBundle\Entity\DescripcionEspecificacionRepository")
 */
class DescripcionEspecificacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=100)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="especificacionId", type="integer")
     */
    private $especificacionId;

    /**
    * @ORM\ManyToOne(targetEntity="Especificacion", inversedBy="DescripcionEspecificacion")
    * @ORM\JoinColumn(name="especificacionId", referencedColumnName="id")
    */
    protected $especificacion;

    /**
     * @ORM\ManyToMany(targetEntity="Producto", mappedBy="descripcionEspecificacion")
     */
    protected $productos;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return DescripcionEspecificacion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set especificacionId
     *
     * @param integer $especificacionId
     * @return DescripcionEspecificacion
     */
    public function setEspecificacionId($especificacionId)
    {
        $this->especificacionId = $especificacionId;
    
        return $this;
    }

    /**
     * Get especificacionId
     *
     * @return integer 
     */
    public function getEspecificacionId()
    {
        return $this->especificacionId;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->productos = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set especificacion
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\Especificacion $especificacion
     * @return DescripcionEspecificacion
     */
    public function setEspecificacion(\PuntoVenta\PuntoVentaBundle\Entity\Especificacion $especificacion = null)
    {
        $this->especificacion = $especificacion;
    
        return $this;
    }

    /**
     * Get especificacion
     *
     * @return \PuntoVenta\PuntoVentaBundle\Entity\Especificacion 
     */
    public function getEspecificacion()
    {
        return $this->especificacion;
    }

    /**
     * Add productos
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\Producto $productos
     * @return DescripcionEspecificacion
     */
    public function addProducto(\PuntoVenta\PuntoVentaBundle\Entity\Producto $productos)
    {
        $this->productos[] = $productos;
    
        return $this;
    }

    /**
     * Remove productos
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\Producto $productos
     */
    public function removeProducto(\PuntoVenta\PuntoVentaBundle\Entity\Producto $productos)
    {
        $this->productos->removeElement($productos);
    }

    /**
     * Get productos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductos()
    {
        return $this->productos;
    }
}