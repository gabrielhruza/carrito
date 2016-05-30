<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Producto
 *
 * @ORM\Table(name="producto")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductoRepository")
 */
class Producto
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=200)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="cortadesc", type="string", length=255)
     */
    private $cortadesc;

    /**
     * @var string
     *
     * @ORM\Column(name="completadesc", type="string", length=255)
     */
    private $completadesc;

    /**
     * @var string
     *
     * @ORM\Column(name="precio", type="string", length=255)
     */
    private $precio;

    /**
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="productos")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id", nullable=false)
     */
    private $categoria;


    /**
     * @ORM\OneToMany(targetEntity="CarritoProducto", mappedBy="producto")
     */
    private $producto_carritos;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->producto_carritos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Producto
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
     * Set cortadesc
     *
     * @param string $cortadesc
     *
     * @return Producto
     */
    public function setCortadesc($cortadesc)
    {
        $this->cortadesc = $cortadesc;

        return $this;
    }

    /**
     * Get cortadesc
     *
     * @return string
     */
    public function getCortadesc()
    {
        return $this->cortadesc;
    }

    /**
     * Set completadesc
     *
     * @param string $completadesc
     *
     * @return Producto
     */
    public function setCompletadesc($completadesc)
    {
        $this->completadesc = $completadesc;

        return $this;
    }

    /**
     * Get completadesc
     *
     * @return string
     */
    public function getCompletadesc()
    {
        return $this->completadesc;
    }

    /**
     * Set precio
     *
     * @param string $precio
     *
     * @return Producto
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set categoria
     *
     * @param \AppBundle\Entity\Categoria $categoria
     *
     * @return Producto
     */
    public function setCategoria(\AppBundle\Entity\Categoria $categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \AppBundle\Entity\Categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Add productoCarrito
     *
     * @param \AppBundle\Entity\CarritoProducto $productoCarrito
     *
     * @return Producto
     */
    public function addProductoCarrito(\AppBundle\Entity\CarritoProducto $productoCarrito)
    {
        $this->producto_carritos[] = $productoCarrito;

        return $this;
    }

    /**
     * Remove productoCarrito
     *
     * @param \AppBundle\Entity\CarritoProducto $productoCarrito
     */
    public function removeProductoCarrito(\AppBundle\Entity\CarritoProducto $productoCarrito)
    {
        $this->producto_carritos->removeElement($productoCarrito);
    }

    /**
     * Get productoCarritos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductoCarritos()
    {
        return $this->producto_carritos;
    }
}
