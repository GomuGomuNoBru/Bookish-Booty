<?php

namespace App\Controller;

use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        // Retrieve books from the database using the injected entity manager
        $books = $this->entityManager->getRepository(Book::class)->findAll();

        return $this->render('default/index.html.twig', [
            'books' => $books,
        ]);
    }
}

