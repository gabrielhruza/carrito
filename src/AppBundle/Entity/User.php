<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Carrito", mappedBy="user", cascade={"persist"})
     */
    private $carrito;


    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->carrito = new Carrito();
        $this->carrito->setUser($this);
    }


    /**
     * Set carrito
     *
     * @param \AppBundle\Entity\Carrito $carrito
     *
     * @return User
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
}
