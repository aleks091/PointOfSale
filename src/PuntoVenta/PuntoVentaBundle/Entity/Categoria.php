<?php

namespace PuntoVenta\PuntoVentaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Categoria
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PuntoVenta\PuntoVentaBundle\Entity\CategoriaRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Categoria
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
     * @Assert\NotBlank() 
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCreada", type="date")
     */
    private $fechaCreada;

    /**
     * @ORM\OneToMany(targetEntity="Producto", mappedBy="categoria")
     */
    protected $productos;

    /**
     * @ORM\OneToMany(targetEntity="Especificacion", mappedBy="categoria")
     */
    protected $especificaciones;

    public function __construct(){
        $this->productos = new ArrayCollection();
        $this->especificaciones = new ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Categoria
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set fechaCreada
     *
     * @param \DateTime $fechaCreada
     * @return Categoria
     */
    public function setFechaCreada($fechaCreada)
    {
        $this->fechaCreada = $fechaCreada;
    
        return $this;
    }

    /**
     * Get fechaCreada
     *
     * @return \DateTime 
     */
    public function getFechaCreada()
    {
        return $this->fechaCreada;
    }

    /**
    *   @ORM\PrePersist
    */
    public function prePersist(){
        $this->fechaCreada = new \DateTime();
    }

    /**
    *   @ORM\PreUpdate
    */
    public function preUpdate(){
        if($this->fechaCreada === null){
            $this->fechaCreada = new \DateTime();
        }
    }

    /**
     * Add productos
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\Producto $productos
     * @return Categoria
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

    /**
     * Add especificaciones
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\Especificacion $especificaciones
     * @return Categoria
     */
    public function addEspecificacione(\PuntoVenta\PuntoVentaBundle\Entity\Especificacion $especificaciones)
    {
        $this->especificaciones[] = $especificaciones;
    
        return $this;
    }

    /**
     * Remove especificaciones
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\Especificacion $especificaciones
     */
    public function removeEspecificacione(\PuntoVenta\PuntoVentaBundle\Entity\Especificacion $especificaciones)
    {
        $this->especificaciones->removeElement($especificaciones);
    }

    /**
     * Get especificaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEspecificaciones()
    {
        return $this->especificaciones;
    }
}