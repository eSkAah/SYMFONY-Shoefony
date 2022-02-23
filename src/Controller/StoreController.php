<?php

namespace App\Controller;

use App\Entity\Store\Brand;
use App\Entity\Store\Product;
use App\Repository\Store\BrandRepository;
use App\Repository\Store\ProductRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;


class StoreController extends AbstractController
{
    private EntityManager $em;
    private BrandRepository $brandRepository;
    private ProductRepository $productRepository;

    public function __construct(EntityManagerInterface $em, BrandRepository $brandRepository, ProductRepository $productRepository){
        $this->em = $em;
        $this->brandRepository = $brandRepository;
        $this->productRepository = $productRepository;
    }

    #[Route('/products', name: 'store_products')]
    #[Route('/products/{brandId}', name: 'store_products_by_brand', requirements: ["brandId" =>"\d+"])]
    public function products(?int $brandId): Response
    {

        if ($brandId) {
            $brand = $this->brandRepository->find($brandId);
            $products = $this->productRepository->findByBrand($brandId);
        } else {
            $products = $this->productRepository->findAll();
            $brand = null;
        }

        return $this->render('store/index.html.twig', [
            'products' => $products,
            'brands' => $this->brandRepository->findAll(),
            'brandId' => $brandId,
            'brand' => $brand
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


    public function listBrand(?int $brandId): Response
    {
        return $this->render('store/_list.brands.html.twig', [
            'brands' =>  $this->brandRepository->findAll(),
            'brandId' => $brandId
        ]);
    }



}