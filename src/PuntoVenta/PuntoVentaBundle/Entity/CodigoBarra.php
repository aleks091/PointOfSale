<?php

namespace PuntoVenta\PuntoVentaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CodigoBarra
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PuntoVenta\PuntoVentaBundle\Entity\CodigoBarraRepository")
 */
class CodigoBarra
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
     * @var integer
     *
     * @ORM\Column(name="productoId", type="integer")
     */
    private $productoId;

    /**
    * @ORM\ManyToOne(targetEntity="Producto", inversedBy="codigoBarra")
    * @ORM\JoinColumn(name="productoId", referencedColumnName="id")
    */
    protected $producto;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=50)
     */
    private $codigo;


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
     * Set productoId
     *
     * @param integer $productoId
     * @return CodigoBarra
     */
    public function setProductoId($productoId)
    {
        $this->productoId = $productoId;
    
        return $this;
    }

    /**
     * Get productoId
     *
     * @return integer 
     */
    public function getProductoId()
    {
        return $this->productoId;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return CodigoBarra
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    
        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set producto
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\Producto $producto
     * @return CodigoBarra
     */
    public function setProducto(\PuntoVenta\PuntoVentaBundle\Entity\Producto $producto = null)
    {
        $this->producto = $producto;
    
        return $this;
    }

    /**
     * Get producto
     *
     * @return \PuntoVenta\PuntoVentaBundle\Entity\Producto 
     */
    public function getProducto()
    {
        return $this->producto;
    }
}