<?php

namespace PuntoVenta\PuntoVentaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * tipoCambio
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PuntoVenta\PuntoVentaBundle\Entity\tipoCambioRepository")
 */
class tipoCambio
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
     * @ORM\Column(name="fechaAgregado", type="datetime")
     */
    private $fechaAgregado;

    /**
     * @var float
     *
     * @ORM\Column(name="tipoCambio", type="float")
     */
    private $tipoCambio;


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
     * Set fechaAgregado
     *
     * @param \DateTime $fechaAgregado
     * @return tipoCambio
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
     * Set tipoCambio
     *
     * @param float $tipoCambio
     * @return tipoCambio
     */
    public function setTipoCambio($tipoCambio)
    {
        $this->tipoCambio = $tipoCambio;
    
        return $this;
    }

    /**
     * Get tipoCambio
     *
     * @return float 
     */
    public function getTipoCambio()
    {
        return $this->tipoCambio;
    }
}