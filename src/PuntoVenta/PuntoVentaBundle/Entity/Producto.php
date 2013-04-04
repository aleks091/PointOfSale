<?php

namespace PuntoVenta\PuntoVentaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @ORM\OneToMany(targetEntity="CodigoBarra", mappedBy="Producto")
     */
    protected $codigosBarras;

    /**
     * @ORM\OneToMany(targetEntity="FotoProducto", mappedBy="Producto")
     */
    protected $fotosProducto;

    /**
     * @ORM\ManyToMany(targetEntity="DescripcionEspecificacion", mappedBy="Producto")
     * @ORM\JoinTable(name="ProductoEspecificaciones",
     *      joinColumns={@ORM\JoinColumn(name="descripcionEspecificacionId", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="productoId", referencedColumnName="id")}
     *      )
     */
    protected $descripcionEspecificaciones;

    /**
     * @ORM\OneToMany(targetEntity="VentaUnitaria", mappedBy="Producto")
     */
    protected $ventasUnitarias;


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


    public function __construct(){
        $this->codigosBarras = new ArrayCollection();
        $this->fotosProducto = new ArrayCollection();
        $this->descripcionEspecificaciones = new ArrayCollection();
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

    /**
     * Add codigosBarras
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\CodigoBarra $codigosBarras
     * @return Producto
     */
    public function addCodigosBarra(\PuntoVenta\PuntoVentaBundle\Entity\CodigoBarra $codigosBarras)
    {
        $this->codigosBarras[] = $codigosBarras;
    
        return $this;
    }

    /**
     * Remove codigosBarras
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\CodigoBarra $codigosBarras
     */
    public function removeCodigosBarra(\PuntoVenta\PuntoVentaBundle\Entity\CodigoBarra $codigosBarras)
    {
        $this->codigosBarras->removeElement($codigosBarras);
    }

    /**
     * Get codigosBarras
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCodigosBarras()
    {
        return $this->codigosBarras;
    }

    /**
     * Add fotosProducto
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\FotoProducto $fotosProducto
     * @return Producto
     */
    public function addFotosProducto(\PuntoVenta\PuntoVentaBundle\Entity\FotoProducto $fotosProducto)
    {
        $this->fotosProducto[] = $fotosProducto;
    
        return $this;
    }

    /**
     * Remove fotosProducto
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\FotoProducto $fotosProducto
     */
    public function removeFotosProducto(\PuntoVenta\PuntoVentaBundle\Entity\FotoProducto $fotosProducto)
    {
        $this->fotosProducto->removeElement($fotosProducto);
    }

    /**
     * Get fotosProducto
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFotosProducto()
    {
        return $this->fotosProducto;
    }

    /**
     * Add descripcionEspecificaciones
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\DescripcionEspecificacion $descripcionEspecificaciones
     * @return Producto
     */
    public function addDescripcionEspecificacione(\PuntoVenta\PuntoVentaBundle\Entity\DescripcionEspecificacion $descripcionEspecificaciones)
    {
        $this->descripcionEspecificaciones[] = $descripcionEspecificaciones;
    
        return $this;
    }

    /**
     * Remove descripcionEspecificaciones
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\DescripcionEspecificacion $descripcionEspecificaciones
     */
    public function removeDescripcionEspecificacione(\PuntoVenta\PuntoVentaBundle\Entity\DescripcionEspecificacion $descripcionEspecificaciones)
    {
        $this->descripcionEspecificaciones->removeElement($descripcionEspecificaciones);
    }

    /**
     * Get descripcionEspecificaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDescripcionEspecificaciones()
    {
        return $this->descripcionEspecificaciones;
    }

    /**
     * Add ventasUnitarias
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\VentaUnitaria $ventasUnitarias
     * @return Producto
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