<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FooController extends Controller
{
    /**
     * @Route("/foo", name="foo")
     */
    public function index()
    {
        return $this->render('foo/index.html.twig', [
            'controller_name' => 'FooController',
        ]);
    }
}
