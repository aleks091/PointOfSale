<?php

namespace PuntoVenta\PuntoVentaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FotoProducto
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PuntoVenta\PuntoVentaBundle\Entity\FotoProductoRepository")
 */
class FotoProducto
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
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="productoId", type="integer")
     */
    private $productoId;

    /**
    * @ORM\ManyToOne(targetEntity="Producto", inversedBy="fotoProducto")
    * @ORM\JoinColumn(name="productoId", referencedColumnName="id")
    */
    protected $producto;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=255)
     */
    private $ruta;


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
     * @return FotoProducto
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
     * Set productoId
     *
     * @param integer $productoId
     * @return FotoProducto
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
     * Set ruta
     *
     * @param string $ruta
     * @return FotoProducto
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;
    
        return $this;
    }

    /**
     * Get ruta
     *
     * @return string 
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set producto
     *
     * @param \PuntoVenta\PuntoVentaBundle\Entity\Producto $producto
     * @return FotoProducto
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