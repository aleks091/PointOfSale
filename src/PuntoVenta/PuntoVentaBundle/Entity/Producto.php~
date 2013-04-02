<?php

namespace PuntoVenta\PuntoVentaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Producto
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PuntoVenta\PuntoVentaBundle\Entity\ProductoRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Producto
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
     * @var float
     *
     * @ORM\Column(name="precioUnitario", type="float")
     */
    private $precioUnitario;

    /**
     * @var integer
     *
     * @ORM\Column(name="categoriaId", type="integer")
     */
    private $categoriaId;

    /**
    * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="Producto")
    * @ORM\JoinColumn(name="categoriaId", referencedColumnName="id")
    */
    protected $categoria;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAgregado", type="date")
     */
    private $fechaAgregado;

    /**
    * @ORM\Column(name="disponibles", type="integer")
    */
    private $disponibles;

    /**
    * @ORM\Column(name="puntoReorden", type="integer")
    */
    private $puntoReorden;

    /**
    * @ORM\Column(name="unidadMedida", type="string", nullable=true)
    */
    private $unidadMedida;


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
     * @return Producto
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
     * Set precioUnitario
     *
     * @param float $precioUnitario
     * @return Producto
     */
    public function setPrecioUnitario($precioUnitario)
    {
        $this->precioUnitario = $precioUnitario;
    
        return $this;
    }

    /**
     * Get precioUnitario
     *
     * @return float 
     */
    public function getPrecioUnitario()
    {
        return $this->precioUnitario;
    }

    /**
     * Set categoriaId
     *
     * @param integer $categoriaId
     * @return Producto
     */
    public function setCategoriaId($categoriaId)
    {
        $this->categoriaId = $categoriaId;
    
        return $this;
    }

    /**
     * Get categoriaId
     *
     * @return integer 
     */
    public function getCategoriaId()
    {
        return $this->categoriaId;
    }

    /**
     * Set fechaAgregado
     *
     * @param \DateTime $fechaAgregado
     * @return Producto
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
     * Set categoria
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\Categoria $categoria
     * @return Producto
     */
    public function setCategoria(\PuntoVenta\PuntoVentaBundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;
    
        return $this;
    }

    /**
     * Get categoria
     *
     * @return \PuntoVenta\PuntoVentaBundle\Entity\Categoria 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set disponibles
     *
     * @param integer $disponibles
     * @return Producto
     */
    public function setDisponibles($disponibles)
    {
        $this->disponibles = $disponibles;
    
        return $this;
    }

    /**
     * Get disponibles
     *
     * @return integer 
     */
    public function getDisponibles()
    {
        return $this->disponibles;
    }

    /**
     * Set puntoReorden
     *
     * @param integer $puntoReorden
     * @return Producto
     */
    public function setPuntoReorden($puntoReorden)
    {
        $this->puntoReorden = $puntoReorden;
    
        return $this;
    }

    /**
     * Get puntoReorden
     *
     * @return integer 
     */
    public function getPuntoReorden()
    {
        return $this->puntoReorden;
    }

    /**
     * Set unidadMedida
     *
     * @param string $unidadMedida
     * @return Producto
     */
    public function setUnidadMedida($unidadMedida)
    {
        $this->unidadMedida = $unidadMedida;
    
        return $this;
    }

    /**
     * Get unidadMedida
     *
     * @return string 
     */
    public function getUnidadMedida()
    {
        return $this->unidadMedida;
    }
}