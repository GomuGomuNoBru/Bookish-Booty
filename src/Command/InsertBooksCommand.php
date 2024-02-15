<?php

namespace App\Command;

use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:insert-books',
    description: 'Adds books to the db',
    hidden: false,
    aliases: ['app:insert-books']
)]
class InsertBooksCommand extends Command
{
    protected static $defaultName = 'app:insert-books';
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this->setDescription('Adds books to the database');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Create and persist book entities
        for ($i = 11; $i <= 12; $i++) {
            $book = new Book();
            $book->setName('Book ' . $i);
            $book->setDescription('Author ' . $i);
            $book->setPrice(rand(10, 50)); // Random price between 10 and 50
            // You can set other properties like image path, description, etc. if needed

            $this->entityManager->persist($book);
        }

        $this->entityManager->flush();

        $io->success('Books inserted successfully.');

        return Command::SUCCESS;
    }
}
