<?php

namespace App\Controller;

use App\Entity\Store\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class StoreController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    #[Route('/products', name: 'store_products')]
    public function products(): Response
    {
        $productRepository = $this->em->getRepository(Product::class);
        $products = $productRepository->findAll();

        return $this->render('store/index.html.twig', [
            'products' => $products
        ]);
    }

    #[Route('/store/product/{id}/details/{slug}', name: 'store_show_product', requirements: ["id" =>"\d+"])]
    public function showProduct(Request $request, int $id, string $slug): Response
    {
        $productRepository = $this->em->getRepository(Product::class);
        $product = $productRepository->find($id);


        if(!$product){
            throw $this->createNotFoundException(
                'No product found for id : ' . $id
            );
        }

        return $this->render('store/details.html.twig', [
            'controller_name' => 'StoreController',
            'id' => $id,
            'product' => $product,
        ]);
    }

}