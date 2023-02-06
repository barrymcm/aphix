<?php

declare(strict_types=1);

namespace App\Controller;

use App\Http\ProductsApiClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CheckoutController extends AbstractController
{

    public function index(ProductsApiClient $client): Response
    {
        $results = $client->fetchProducts();

        return $this->render('checkout.html.twig', ["products" => $results]);
    }

    public function addItemToCart(Request $request, ProductsApiClient $client)
    {
        $results = $client->fetchProducts();

        $item = $request->get('productId');
        $quantity = $request->get('quantity');

        // insert data into the cart table

        return $this->render('checkout.html.twig', ["products" => $results]);
    }
}