<?php

namespace App\Controller;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{

    public function viewCart(Request $request)
    {
        // Retrieve the cart items from the session
        $cartItems = $request->getSession()->get('cart', []);

        return $this->render('cart/cart.html.twig', [
            'cartItems' => $cartItems,
        ]);
    }
    /**
     * @Route("/add-to-cart/{bookId}", name="add_to_cart", methods={"POST"})
     */
    public function addToCart(Request $request, $bookId): JsonResponse
    {
        // Retrieve the book from the database based on the provided bookId
        $book = $this->getDoctrine()->getRepository(Book::class)->find($bookId);

        // Check if the book exists
        if (!$book) {
            return new JsonResponse(['error' => 'Book not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        // Optionally, you can retrieve additional data from the request (e.g., quantity)
        $data = json_decode($request->getContent(), true);
        $quantity = $data['quantity'] ?? 1; // Default to 1 if quantity is not provided

        // Add the book to the shopping cart (you need to implement your shopping cart logic here)
        // For demonstration purposes, let's assume we have a session-based shopping cart
        $cart = $request->getSession()->get('cart', []);
        $cart[] = [
            'id' => $bookId,
            'title' => $book->getName(),
            'price' => $book->getPrice(),
            'quantity' => $quantity,
            // Add other book details as needed
        ];
        $request->getSession()->set('cart', $cart);

        // You can return the updated cart data in the response
        $totalItems = count($cart);
        return new JsonResponse(['success' => true, 'totalItems' => $totalItems]);
    }
}
