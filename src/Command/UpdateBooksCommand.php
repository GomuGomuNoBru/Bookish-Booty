<?php

namespace App\Command;

use App\Entity\Book;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;


#[AsCommand(
    name: 'UpdateBooksCommand',
    description: 'Updates existing books in the db',
    hidden: false,
    aliases: ['app:update-books']
)]
class UpdateBooksCommand extends Command
{
    protected static $defaultName = 'app:update-books';

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Updates existing books in the database with author and image properties')
            ->setHelp('This command updates existing books in the database by adding author and image properties.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $books = $this->entityManager->getRepository(Book::class)->findAll();

        foreach ($books as $book) {
            // Generate dummy author data for each book
            $author = 'Author_' . $book->getId();

            // Generate dynamic image path based on book ID
            $imageNumber = $book->getId() % 6 + 1; // Generate a number between 1 and 6
            $image = 'images/image_' . $imageNumber . '.jpg';

            // Update the book entity
            $book->setAuthor($author);
            $book->setImage($image);

            // Persist the changes
            $this->entityManager->persist($book);
        }

        // Flush changes to the database
        $this->entityManager->flush();

        $output->writeln('Books updated successfully.');

        return Command::SUCCESS;
    }
}