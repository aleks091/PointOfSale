<?php

namespace PuntoVenta\PuntoVentaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Especificacion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PuntoVenta\PuntoVentaBundle\Entity\EspecificacionRepository")
 */
class Especificacion
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
     * @ORM\Column(name="categoriaId", type="integer")
     */
    private $categoriaId;

    /**
    * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="especificaciones")
    * @ORM\JoinColumn(name="categoriaId", referencedColumnName="id")
    */
    protected $categoria;



    /**
     * @var string
     *
     * @ORM\Column(name="especificacion", type="string", length=100)
     */
    private $especificacion;

   /**
     * @ORM\OneToMany(targetEntity="DescripcionEspecificacion", mappedBy="especificacion")
     */
    protected $descripcionesEspecificacion;


    public function __construct(){
        $this->descripcionesEspecificacion = new ArrayCollection();
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
     * Set categoriaId
     *
     * @param integer $categoriaId
     * @return Especificacion
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
     * Set especificacion
     *
     * @param string $especificacion
     * @return Especificacion
     */
    public function setEspecificacion($especificacion)
    {
        $this->especificacion = $especificacion;
    
        return $this;
    }

    /**
     * Get especificacion
     *
     * @return string 
     */
    public function getEspecificacion()
    {
        return $this->especificacion;
    }

    /**
     * Add descripcionesEspecificacion
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\DescripcionEspecificacion $descripcionesEspecificacion
     * @return Especificacion
     */
    public function addDescripcionesEspecificacion(\PuntoVenta\PuntoVentaBundle\Entity\DescripcionEspecificacion $descripcionesEspecificacion)
    {
        $this->descripcionesEspecificacion[] = $descripcionesEspecificacion;
    
        return $this;
    }

    /**
     * Remove descripcionesEspecificacion
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\DescripcionEspecificacion $descripcionesEspecificacion
     */
    public function removeDescripcionesEspecificacion(\PuntoVenta\PuntoVentaBundle\Entity\DescripcionEspecificacion $descripcionesEspecificacion)
    {
        $this->descripcionesEspecificacion->removeElement($descripcionesEspecificacion);
    }

    /**
     * Get descripcionesEspecificacion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDescripcionesEspecificacion()
    {
        return $this->descripcionesEspecificacion;
    }

    /**
     * Set categoria
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\Categoria $categoria
     * @return Especificacion
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
}