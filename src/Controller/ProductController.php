<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Order;
use App\Entity\Product;
use App\Form\PizzaFormType;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function showHome(ManagerRegistry $doctrine): Response
    {

        $category = $doctrine->getRepository(Category::class)->findAll();
        // dd($products);
        return $this->render("home.html.twig",['category'=> $category]);
    }
    #[Route("/pizzas/{id}", name: "pizzas")]
    public function showPizza(ManagerRegistry $doctrine, $id): Response
    {

        $category = $doctrine->getRepository(Category::class)->find($id);
        // dd($products);
        return $this->render("pizzas.html.twig",['category'=> $category]);
    }

    #[Route("/contact", name: "contact")]
    public function showContact(): Response
    {
        return $this->render("contact.html.twig");
    }
    #[Route("/login", name: "login")]
    public function showLogin(): Response
    {
        return $this->render("login.html.twig");
    }
    #[Route("/form", name: "form")]
    public function showForm(Request $request): Response
    {
        $task = new Order();


        $form = $this->createForm(PizzaFormType::class, $task);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();
            
            return $this->redirectToRoute('task_success');
        }

        return $this->renderForm('form.html.twig', [
            'form' => $form,
        ]);

    }


    #[Route('/product', name: 'product')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $category = new Category();
        $category->setName('Computer Peripherals');

        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(19);
        $product->setDescription('Ergonomic and stylish!');

        // relates this product to the category
        $product->setCategory($category);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($category);
        $entityManager->persist($product);
        $entityManager->flush();

        return new Response(
            'Saved new product with id: '.$product->getId()
            .' and new category with id: '.$category->getId()
        );
    }
}