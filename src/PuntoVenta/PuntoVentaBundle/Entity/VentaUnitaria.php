<?php

namespace PuntoVenta\PuntoVentaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * VentaUnitaria
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PuntoVenta\PuntoVentaBundle\Entity\VentaUnitariaRepository")
 */
class VentaUnitaria
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
     * @ORM\Column(name="cantidadProducto", type="integer")
     */
    private $cantidadProducto;

    /**
     * @var float
     *
     * @ORM\Column(name="importe", type="float")
     */
    private $importe;

    /**
     * @var integer
     *
     * @ORM\Column(name="ventaId", type="integer")
     */
    private $ventaId;

    /**
     * @var integer
     *
     * @ORM\Column(name="productoId", type="integer")
     */
    private $productoId;

    /**
    * @ORM\ManyToOne(targetEntity="Producto", inversedBy="ventaUnitaria")
    * @ORM\JoinColumn(name="productoId", referencedColumnName="id")
    */
    protected $producto;
    
    
  	protected $productos;
    protected $categorias;


    /**
    * @ORM\ManyToOne(targetEntity="Venta", inversedBy="VentaUnitaria")
    * @ORM\JoinColumn(name="productoId", referencedColumnName="id")
    */
    protected $venta;
    
    function __construct(){
    	$this->productos = new ArrayCollection();
    	$this->categorias = new ArrayCollection();
    }
    
    
    public function getProductos(){
    	return $this->productos;
    }
    public function setProductos(ArrayCollection $productos){
    	$this->productos = $productos;
    }
    
    public function getCategorias(){
    	return $this->categorias;
    }
    public function setCategorias(ArrayCollection $categorias){
    	$this->categorias = $categorias;
    }


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
     * Set cantidadProducto
     *
     * @param integer $cantidadProducto
     * @return VentaUnitaria
     */
    public function setCantidadProducto($cantidadProducto)
    {
        $this->cantidadProducto = $cantidadProducto;
    
        return $this;
    }

    /**
     * Get cantidadProducto
     *
     * @return integer 
     */
    public function getCantidadProducto()
    {
        return $this->cantidadProducto;
    }

    /**
     * Set importe
     *
     * @param float $importe
     * @return VentaUnitaria
     */
    public function setImporte($importe)
    {
        $this->importe = $importe;
    
        return $this;
    }

    /**
     * Get importe
     *
     * @return float 
     */
    public function getImporte()
    {
        return $this->importe;
    }

    /**
     * Set ventaId
     *
     * @param integer $ventaId
     * @return VentaUnitaria
     */
    public function setVentaId($ventaId)
    {
        $this->ventaId = $ventaId;
    
        return $this;
    }

    /**
     * Get ventaId
     *
     * @return integer 
     */
    public function getVentaId()
    {
        return $this->ventaId;
    }

    /**
     * Set productoId
     *
     * @param integer $productoId
     * @return VentaUnitaria
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
     * Set venta
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\Venta $venta
     * @return VentaUnitaria
     */
    public function setVenta(\PuntoVenta\PuntoVentaBundle\Entity\Venta $venta = null)
    {
        $this->venta = $venta;
    
        return $this;
    }

    /**
     * Get venta
     *
     * @return \PuntoVenta\PuntoVentaBundle\Entity\Venta 
     */
    public function getVenta()
    {
        return $this->venta;
    }

    /**
     * Set producto
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\Producto $producto
     * @return VentaUnitaria
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