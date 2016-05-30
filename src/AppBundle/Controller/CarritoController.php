<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Carrito;
use AppBundle\Form\CarritoType;

use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\CarritoProducto;

/**
 * Carrito controller.
 *
 * @Route("/carrito")
 */
class CarritoController extends Controller
{
    /**
     * Lists all Carrito entities.
     *
     * @Route("/", name="carrito_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $carritos = $em->getRepository('AppBundle:Carrito')->findAll();

        return $this->render('carrito/index.html.twig', array(
            'carritos' => $carritos,
        ));
    }

    /**
     * Creates a new Carrito entity.
     *
     * @Route("/new", name="carrito_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $carrito = new Carrito();
        $form = $this->createForm('AppBundle\Form\CarritoType', $carrito);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carrito);
            $em->flush();

            return $this->redirectToRoute('carrito_show', array('id' => $carrito->getId()));
        }

        return $this->render('carrito/new.html.twig', array(
            'carrito' => $carrito,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Carrito entity.
     *
     * @Route("/{id}", name="carrito_show")
     * @Method("GET")
     */
    public function showAction(Carrito $carrito)
    {
        $deleteForm = $this->createDeleteForm($carrito);

        return $this->render('carrito/show.html.twig', array(
            'carrito' => $carrito,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Carrito entity.
     *
     * @Route("/{id}/edit", name="carrito_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Carrito $carrito)
    {
        $deleteForm = $this->createDeleteForm($carrito);
        $editForm = $this->createForm('AppBundle\Form\CarritoType', $carrito);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carrito);
            $em->flush();

            return $this->redirectToRoute('carrito_edit', array('id' => $carrito->getId()));
        }

        return $this->render('carrito/edit.html.twig', array(
            'carrito' => $carrito,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Carrito entity.
     *
     * @Route("/{id}", name="carrito_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Carrito $carrito)
    {
        $form = $this->createDeleteForm($carrito);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($carrito);
            $em->flush();
        }

        return $this->redirectToRoute('carrito_index');
    }

    /**
     * Creates a form to delete a Carrito entity.
     *
     * @param Carrito $carrito The Carrito entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Carrito $carrito)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('carrito_delete', array('id' => $carrito->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    
    /**
     * Add a product to the Carrito entity.
     *
     * @Route("/addproduct/{id}", name="carrito_addproduct")
     */
    public function addProductAction($id){
        
        $em         = $this->getDoctrine()->getManager();
        $producto   = $em->getRepository('AppBundle:Producto')->find($id);

        $carrito = $this->getUser()->getCarrito();

        $carrito_producto = new CarritoProducto();
        $carrito_producto->setCarrito($carrito);
        $carrito_producto->setProducto($producto);

        $this->getUser()->getCarrito()->addCarritoProducto($carrito_producto);

        $carrito->actualizarMonto();
        $em->persist($carrito);
        $em->flush();

        return new JsonResponse('Producto: ' . 'hola' . ' agregado correctamente.');
    }

}
