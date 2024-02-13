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


        return $this->render('book/show.html.twig', [
            'book_id' => $id,
        ]);
    }
}
