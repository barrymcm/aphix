<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Http\ProductsApiClient;

class ProductsController extends AbstractController
{

    public function index(ProductsApiClient $client): Response
    {
        $results = $client->fetchProducts();

        return $this->render('products.html.twig', ["products" => $results]);
    }
}