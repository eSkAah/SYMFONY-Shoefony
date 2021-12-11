<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class StoreController extends AbstractController
{
    #[Route('/store/product/{id}/details/{slug}', name: 'store_show_product', requirements: ["id" =>"\d+"])]
    public function showProduct(Request $request, int $id, string $slug): Response
    {

        $ipClient = $request->server->get('REMOTE_ADDR');
        $uri = $request->getUri();
        


        return $this->render('store/details.html.twig', [
            'controller_name' => 'StoreController',
            'id' => $id,
            'slug' => $slug,
            'ipClient' => $ipClient,
            'uri' => $uri,
        ]);
    }


    #[Route('/products', name: 'store_products')]
    public function products(): Response
    {
        return $this->render('store/index.html.twig', [
            'controller_name' => 'StoreController',
        ]);
    }



}
    
