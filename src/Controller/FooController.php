<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Products;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FooController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $products = $this->findAllData(Products::class);
        $categories = $this->findAllData(Categories::class);


        return $this->render('foo/index.html.twig', [
            'controller_name' => 'FooController',
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/category/product", name="cat_and_prod")
     */
    public function productAndCategory (Request $request)
    {
        $product = new Products();
        $product->setTitle('Book');
        $product->setPrice(13.99);
        $product->category('Fantasy');

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return $this->redirectToRoute('home');
    }

    /**
     * @param Request $request
     * @Route("/remove/product/{id}", name="remove_product")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeProduct (Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $challenge = $em->find('App:Products', $request->attributes->get('id'));

        $em->remove($challenge);
        $em->flush();

        return $this->redirectToRoute('home');
    }

    /**
     * @param string $class
     * @return array
     */
    private function findAllData (string $class) : array
    {
        $em = $this->getDoctrine()->getRepository($class);
        return $em->findAll();
    }

}
