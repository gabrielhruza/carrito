<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * Lists all Producto entities.
     *
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {   
        $session = $request->getSession();
        //$session->set('carrito', );

        $em = $this->getDoctrine()->getManager();

        $productos = $em->getRepository('AppBundle:Producto')->findAll();

        return $this->render('default/index.html.twig', array(
            'productos' => $productos,
        ));
    }

    /**
     * List all products from de Carrito entity.
     *
     * @Route("/micarrito", name="carrito_productos")
     */
    public function listProductAction(){

        if( $this->getUser() == null ){

            return new JsonResponse('No tienes productos agregados');

        }else{

            $productos = $this->getUser()->getCarrito()->getProductos();
            return $this->render('carrito/micarrito.html.twig', array(
            'productos' => $productos,
            ));

        }
    }



}
