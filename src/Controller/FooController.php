<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Products;
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
        $em = $this->getDoctrine()->getRepository(Categories::class);
        $categories = $em->findAll();

        $em = $this->getDoctrine()->getRepository(Products::class);
        $prod = $em->findAll();


        return $this->render('foo/index.html.twig', [
            'controller_name' => 'FooController',
            'categories' => $categories,
            'products' => $prod,
        ]);
    }

    /**
     * @Route("/category/{id}/product", name="cat_and_prod")
     */
    public function productAndCategory (Request $request)
    {
        $id = $request->attributes->get('id');
        $em = $this->getDoctrine()->getRepository(Categories::class);

        $product = new Products();
        $product->setTitle('Book');
        $product->setPrice(13.99);
        $product->setCategories(
            array($em->find($id))
        );

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/category/{title}", name="create_category")
     */
    public function createCategory (Request $request)
    {
        $title = $request->attributes->get('title');

        $category = new Categories();
        $category->setTitle($title);

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->flush();

        return $this->redirectToRoute('home');
    }
}
