<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Carrito
 *
 * @ORM\Table(name="carrito")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CarritoRepository")
 */
class Carrito
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
     * @ORM\Column(name="monto", type="string", length=255)
     */
    private $monto;

    /**
     * @ORM\OneToMany(targetEntity="CarritoProducto", mappedBy="carrito", cascade={"persist", "remove"})
     */  
    private $carrito_productos;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="carrito")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

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
        $this->carrito_productos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->monto = 0;
    }

    /**
     * @ORM\PreUpdate()
     */
    public function actualizarMonto(){
        //die(var_dump('hola'));
        $monto      = 0;
        foreach ($this->getCarritoProductos() as $carrito_producto) {
            $monto += ( $carrito_producto->getCantidad() * $carrito_producto->getProducto()->getPrecio() );
        }
        $this->setMonto($monto);
    }

    /**
     * Set monto
     *
     * @param string $monto
     *
     * @return Carrito
     */
    private function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }

    /**
     * Get monto
     *
     * @return string
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Add carritoProducto
     *
     * @param \AppBundle\Entity\CarritoProducto $carritoProducto
     *
     * @return Carrito
     */
    public function addCarritoProducto(\AppBundle\Entity\CarritoProducto $carritoProducto)
    {
        $this->carrito_productos[] = $carritoProducto;

        return $this;
    }

    /**
     * Remove carritoProducto
     *
     * @param \AppBundle\Entity\CarritoProducto $carritoProducto
     */
    public function removeCarritoProducto(\AppBundle\Entity\CarritoProducto $carritoProducto)
    {
        $this->carrito_productos->removeElement($carritoProducto);
    }

    /**
     * Get carritoProductos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCarritoProductos()
    {
        return $this->carrito_productos;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Carrito
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
