<?php

namespace PuntoVenta\PuntoVentaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * IVA
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PuntoVenta\PuntoVentaBundle\Entity\IVARepository")
 * @ORM\HasLifecycleCallbacks()
 */
class IVA
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
     * @var float
     *
     * @ORM\Column(name="iva", type="float")
     */
    private $iva;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAgregado", type="datetime")
     */
    private $fechaAgregado;

    /**
     * @ORM\OneToMany(targetEntity="Venta", mappedBy="iva")
     */
    private $ventas;



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
     * Set iva
     *
     * @param float $iva
     * @return iva
     */
    public function setIva($iva)
    {
        $this->iva = $iva;
    
        return $this;
    }

    /**
     * Get iva
     *
     * @return float 
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set fechaAgregado
     *
     * @param \DateTime $fechaAgregado
     * @return iva
     */
    public function setFechaAgregado($fechaAgregado)
    {
        $this->fechaAgregado = $fechaAgregado;
    
        return $this;
    }

    /**
     * Get fechaAgregado
     *
     * @return \DateTime 
     */
    public function getFechaAgregado()
    {
        return $this->fechaAgregado;
    }

    /**
    *   @ORM\PrePersist
    */
    public function prePersist(){
        $this->fechaAgregado = new \DateTime();
    }

    /**
    *   @ORM\PreUpdate
    */
    public function preUpdate(){
        if($this->fechaAgregado === null){
            $this->fechaAgregado = new \DateTime();
        }
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ventas = new ArrayCollection();
    }
    
    /**
     * Add ventas
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\Venta $ventas
     * @return IVA
     */
    public function addVenta(\PuntoVenta\PuntoVentaBundle\Entity\Venta $ventas)
    {
        $this->ventas[] = $ventas;
    
        return $this;
    }

    /**
     * Remove ventas
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\Venta $ventas
     */
    public function removeVenta(\PuntoVenta\PuntoVentaBundle\Entity\Venta $ventas)
    {
        $this->ventas->removeElement($ventas);
    }

    /**
     * Get ventas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVentas()
    {
        return $this->ventas;
    }
}