<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Book;
use App\Entity\Author;


use App\Form\BookFormType;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface; 


class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    #[Route('/add-book', name: 'add_book')]
public function addBook(Request $request): Response
{
    $book = new Book();
    $form = $this->createForm(BookFormType::class, $book);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Incrémentation de nb_books de l'auteur
        $author = $book->getAuthor();
        $author->setNbBooks($author->getNbBooks() + 1);

        // Enregistrement du livre
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($book);
        $entityManager->flush();

        // Redirection vers la liste des livres (ou autre page)
        return $this->redirectToRoute('book_published_list');
    }

    return $this->render('book/add_book.html.twig', [
        'form' => $form->createView(),
    ]);
   
}



#[Route('/books/published', name: 'book_published_list')]
public function listPublishedBooks(EntityManagerInterface $entityManager): Response
{
    
    $repository = $entityManager->getRepository(Book::class);

    $publishedBooks = $repository->findBy(['published' => true]);
    $unpublishedBooks = $repository->findBy(['published' => false]);

    $queryBuilder = $repository->createQueryBuilder('b')
        ->join('b.author', 'a')
        ->select('b.ref','b.title', 'b.publicationDate', 'b.category','b.published','a.id', 'a.username as authorName')
        ->where('b.published = :published')
        ->setParameter('published', true);

    $publishedBooksData = $queryBuilder->getQuery()->getResult();

    return $this->render('book/list_published.html.twig', [
        'publishedBooksData' => $publishedBooksData,
        'publishedCount' => count($publishedBooks),
        'unpublishedCount' => count($unpublishedBooks),
    ]);
}

#[Route('/book/edit/{ref}', name: 'edit_book')]
public function editBook(Request $request, EntityManagerInterface $entityManager, $ref): Response
{
    $repository = $entityManager->getRepository(Book::class);
    $book = $repository->findOneBy(['ref' => $ref]);

    if (!$book) {
        // Handle the case where the book with the specified ref doesn't exist
        // You can add error handling or redirection here
    }

    $form = $this->createForm(BookFormType::class, $book);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Persist the changes to the database
        $entityManager->flush();

        // Redirect to the book list or another page
        return $this->redirectToRoute('book_published_list');
    }

    return $this->render('book/edit_book.html.twig', [
        'form' => $form->createView(),
    ]);
}



#[Route('/book/delete/{ref}', name: 'delete_book')]
public function deleteBook(Request $request, string $ref): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $book = $entityManager->getRepository(Book::class)->find($ref);

    if (!$book) {
        // Handle the case where the book with the given ref is not found
        // You can redirect to an error page or display an error message.
        // For example:
        // return $this->render('error.html.twig', ['message' => 'Book not found']);
    }

    // Remove the book
    $entityManager->remove($book);
    $entityManager->flush();

    return $this->redirectToRoute('book_published_list');
}



#[Route('/delete-authors', name: 'delete_authors')]
public function deleteAuthorsWithZeroBooks(EntityManagerInterface $entityManager): Response
{
    $authorRepository = $entityManager->getRepository(Author::class);
    $authorsToDelete = $authorRepository->createQueryBuilder('a')
        ->where('a.nb_books = 0')
        ->getQuery()
        ->getResult();

    foreach ($authorsToDelete as $author) {
        $entityManager->remove($author);
    }

    $entityManager->flush();

    return $this->redirectToRoute('book_published_list');
}
    


#[Route('/book/show/{ref}', name: 'show_book')]
public function showBook(Request $request, string $ref): Response
 {
     $entityManager = $this->getDoctrine()->getManager();
     $book = $entityManager->getRepository(Book::class)->find($ref);

     if (!$book) {
         // Handle the case where the book with the given ref is not found
         // You can redirect to an error page or display an error message.
         // For example:
         // return $this->render('error.html.twig', ['message' => 'Book not found']);
     }

     return $this->render('book/show_book.html.twig', [
         'book' => $book,
     ]);
 }

}