<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Book;

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

    /**
     * @Route("/delete-book/{id}", name="delete_book", methods={"DELETE"})
     */
    public function deleteBook($id): JsonResponse
        {
            $entityManager = $this->getDoctrine()->getManager();
            $book = $entityManager->getRepository(Book::class)->find($id);

            if (!$book) {
                return new JsonResponse(['error' => 'Book not found'], JsonResponse::HTTP_NOT_FOUND);
            }

            $entityManager->remove($book);
            $entityManager->flush();

            return new JsonResponse(['success' => true]);
        }
}
