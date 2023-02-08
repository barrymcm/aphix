<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Http\ProductsApiClient;
use Symfony\Component\HttpFoundation\Session\Session;

class ProductsController extends AbstractController
{

    public function index(ProductsApiClient $client, Session $session): Response
    {
        $session->start();
        $products = $client->fetchProducts();

        return $this->render('products.html.twig', [
            "products" => $products,
            'purchaseIdentifier' => strrev(substr($session->getId(), 0, 8)),
            "result" => null
        ]);
    }
}