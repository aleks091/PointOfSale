<?php

namespace PuntoVenta\PuntoVentaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Venta
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PuntoVenta\PuntoVentaBundle\Entity\VentaRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Venta
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
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRealizada", type="datetime")
     */
    private $fechaRealizada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaPagada", type="datetimetz")
     */
    private $fechaPagada;

    /**
     * @var integer
     *
     * @ORM\Column(name="clienteId", type="integer")
     */
    private $clienteId;

    /**
    * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="ventas")
    * @ORM\JoinColumn(name="clienteId", referencedColumnName="id")
    */
    private $cliente;

    /**
    * @ORM\ManyToOne(targetEntity="VentaEstatus", inversedBy="ventas")
    * @ORM\JoinColumn(name="ventaEstusId", referencedColumnName="id")
    */
    private $ventaEstatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="ventaEstusId", type="integer")
     */
    private $ventaEstusId;

    /**
     * @ORM\OneToMany(targetEntity="VentaUnitaria", mappedBy="venta")
     */
    protected $ventasUnitarias;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float")
     */
    private $total;

    /**
     * @var float
     *
     * @ORM\Column(name="subtotal", type="float")
     */
    private $subtotal;

    public function __construct(){
        $this->ventasUnitarias = new ArrayCollection();
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
     * Set fechaRealizada
     *
     * @param \DateTime $fechaRealizada
     * @return Venta
     */
    public function setFechaRealizada($fechaRealizada)
    {
        $this->fechaRealizada = $fechaRealizada;
    
        return $this;
    }

    /**
     * Get fechaRealizada
     *
     * @return \DateTime 
     */
    public function getFechaRealizada()
    {
        return $this->fechaRealizada;
    }

    /**
     * Set fechaPagada
     *
     * @param \DateTime $fechaPagada
     * @return Venta
     */
    public function setFechaPagada($fechaPagada)
    {
        $this->fechaPagada = $fechaPagada;
    
        return $this;
    }

    /**
     * Get fechaPagada
     *
     * @return \DateTime 
     */
    public function getFechaPagada()
    {
        return $this->fechaPagada;
    }

    /**
     * Set cliente
     *
     * @param integer $cliente
     * @return Venta
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    
        return $this;
    }

    /**
     * Get cliente
     *
     * @return integer 
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set productos
     *
     * @param \stdClass $productos
     * @return Venta
     */
    public function setProductos($productos)
    {
        $this->productos = $productos;
    
        return $this;
    }

    /**
     * Get productos
     *
     * @return \stdClass 
     */
    public function getProductos()
    {
        return $this->productos;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return Venta
     */
    public function setTotal($total)
    {
        $this->total = $total;
    
        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set subtotal
     *
     * @param float $subtotal
     * @return Venta
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;
    
        return $this;
    }

    /**
     * Get subtotal
     *
     * @return float 
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Set ventaEstusId
     *
     * @param integer $ventaEstusId
     * @return Venta
     */
    public function setVentaEstusId($ventaEstusId)
    {
        $this->ventaEstusId = $ventaEstusId;
    
        return $this;
    }

    /**
     * Get ventaEstusId
     *
     * @return integer 
     */
    public function getVentaEstusId()
    {
        return $this->ventaEstusId;
    }

    /**
     * Set ventaEstatus
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\VentaEstatus $ventaEstatus
     * @return Venta
     */
    public function setVentaEstatus(\PuntoVenta\PuntoVentaBundle\Entity\VentaEstatus $ventaEstatus = null)
    {
        $this->ventaEstatus = $ventaEstatus;
    
        return $this;
    }

    /**
     * Get ventaEstatus
     *
     * @return \PuntoVenta\PuntoVentaBundle\Entity\VentaEstatus 
     */
    public function getVentaEstatus()
    {
        return $this->ventaEstatus;
    }

    /**
     * Set clienteId
     *
     * @param integer $clienteId
     * @return Venta
     */
    public function setClienteId($clienteId)
    {
        $this->clienteId = $clienteId;
    
        return $this;
    }

    /**
     * Get clienteId
     *
     * @return integer 
     */
    public function getClienteId()
    {
        return $this->clienteId;
    }

    /**
    *   @ORM\PrePersist
    */
    public function prePersist(){
        $this->fechaRealizada = new \DateTime();
    }

    /**
    *   @ORM\PreUpdate
    */
    public function preUpdate(){
        if($this->fechaRealizada === null){
            $this->fechaRealizada = new \DateTime();
        }
    }

    /**
     * Add ventasUnitarias
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\VentaUnitaria $ventasUnitarias
     * @return Venta
     */
    public function addVentasUnitaria(\PuntoVenta\PuntoVentaBundle\Entity\VentaUnitaria $ventasUnitarias)
    {
        $this->ventasUnitarias[] = $ventasUnitarias;
    
        return $this;
    }

    /**
     * Remove ventasUnitarias
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\VentaUnitaria $ventasUnitarias
     */
    public function removeVentasUnitaria(\PuntoVenta\PuntoVentaBundle\Entity\VentaUnitaria $ventasUnitarias)
    {
        $this->ventasUnitarias->removeElement($ventasUnitarias);
    }

    /**
     * Get ventasUnitarias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVentasUnitarias()
    {
        return $this->ventasUnitarias;
    }
}