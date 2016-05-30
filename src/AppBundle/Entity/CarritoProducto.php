<?php 

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Carrito
 *
 * @ORM\Table(name="carrito_producto")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CarritoProductoRepository")
 */
class CarritoProducto
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
    * @ORM\ManyToOne(targetEntity="Carrito", inversedBy="carrito_productos", cascade={"persist"})
    * @ORM\JoinColumn(name="carrito_id", referencedColumnName="id")
    */
    private $carrito;

    /**
    * @ORM\ManyToOne(targetEntity="Producto", inversedBy="producto_carritos", cascade={"persist"})
    * @ORM\JoinColumn(name="producto_id", referencedColumnName="id")
    */
    private $producto;

    /**
    * @var int
    * @ORM\Column(name="cantidad", type="integer")
    */
    private $cantidad;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct(){
        $this->cantidad = 1;
    }
   

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return CarritoProducto
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set carrito
     *
     * @param \AppBundle\Entity\Carrito $carrito
     *
     * @return CarritoProducto
     */
    public function setCarrito(\AppBundle\Entity\Carrito $carrito = null)
    {
        $this->carrito = $carrito;

        return $this;
    }

    /**
     * Get carrito
     *
     * @return \AppBundle\Entity\Carrito
     */
    public function getCarrito()
    {
        return $this->carrito;
    }

    /**
     * Set producto
     *
     * @param \AppBundle\Entity\Producto $producto
     *
     * @return CarritoProducto
     */
    public function setProducto(\AppBundle\Entity\Producto $producto = null)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get producto
     *
     * @return \AppBundle\Entity\Producto
     */
    public function getProducto()
    {
        return $this->producto;
    }
}
