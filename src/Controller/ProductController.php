<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'create_product')]
    public function createProduct(ManagerRegistry $doctrine): Response
    {
        return new Response('<h1>hoi</h1');
    }

    #[Route('/show/product', name: 'show_product')]
    public function showProducts(ManagerRegistry $doctrine): Response
    {
        $products = $doctrine->getRepository(Product::class)->findAll();
       // dd($products);
        return $this->render("showproducts.html.twig",['products'=> $products]);
    }

    #[Route("/", name: "home")]
    public function showHome(): Response
    {
        return $this->render("home.html.twig");
    }
}