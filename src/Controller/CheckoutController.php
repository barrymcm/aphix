<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Cart;
use App\Repository\CartRepository;
use App\Http\ProductsApiClient;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CheckoutController extends AbstractController
{
    /**
     * @throws \Exception
     */
    public function index(
        Request $request,
        ProductsApiClient $client,
        CartRepository $cartRepo
    ): Response
    {
        $purchaseId = $request->get('0');
        $cartItems = $cartRepo->findByPurchaseIdentifier($purchaseId);

        return $this->render('checkout.html.twig',
            [
                'products' => $cartItems,
                'purchaseIdentifier' => $purchaseId
            ]
        );
    }

    /**
     * @param  Request  $request
     * @param  LoggerInterface  $logger
     * @return Response
     */
    public function addItemToCart(
        Request $request,
        LoggerInterface $logger,
        ManagerRegistry $mngrReg,
        ProductsApiClient $client
    ): Response {

        $em = $mngrReg->getManager();

        $id = (int) $request->get('productId');
        $quantity = (int) $request->get('quantity');
        $purchaseIdentifier = (string) $request->get('purchaseIdentifier');
        $productName = (string) $request->get('productName');
        $unitPrice = (int) $request->get('unitPrice');

        $cart = new Cart();

        $cart->setProductId($id);
        $cart->setQuantity($quantity);
        $cart->setpurchaseIdentifier($purchaseIdentifier);
        $cart->setProductName($productName);
        $cart->setUnitPrice($unitPrice);

        try {
            $em->persist($cart);
            $em->flush();
            $products = $client->fetchProducts();

            return $this->render('products.html.twig', [
                "products" => $products,
                'purchaseIdentifier' => $cart->getPurchaseIdentifier(),
                "result" => ""
            ]);

        } catch (ORMException $e) {
            $logger->error("The cart item did not save : ", [$e->getMessage()]);

            return $this->render('products.html.twig',
                [   "products" => $products,
                    'purchaseIdentifier' => $cart->getPurchaseIdentifier(),
                    "result" => "The cart item did not save"
                ]
            );
        }
    }
}