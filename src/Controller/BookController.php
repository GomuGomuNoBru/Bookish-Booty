<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route("/book/{id}", name="book_item")
     */
    public function show($id): Response
    {
        // Fetch the book details from the database using the $id

        return $this->render('book/show.html.twig', [
            'book_id' => $id,
        ]);
    }
}
