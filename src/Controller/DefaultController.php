<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    // ...

    public function index(): Response
    {
        // In a real application, you would fetch books from the database here.
        $books = [
            ['title' => 'Book 1', 'author' => 'Author 1', 'image' => 'images/yoshi.png', 'price' => '20'],
            ['title' => 'Book 2', 'author' => 'Author 2', 'image' => 'images/yoshi.png', 'price' => '20'],
            ['title' => 'Book 3', 'author' => 'Author 3', 'image' => 'images/yoshi.png', 'price' => '20'],
            // Add more books as needed
        ];

        return $this->render('default/index.html.twig', [
            'books' => $books,
        ]);
    }

// ...

}
