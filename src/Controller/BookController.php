<?php

namespace App\Controller;

use App\Form\BookType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Book;

class BookController extends AbstractController
{
    /**
     * @Route("/", name="books")
     *
     * @return Response
     */
    public function books()
    {
        $books = $this->getDoctrine()
            ->getRepository(Book::class)
            ->findAll();
        if (!$books) {
            throw $this->createNotFoundException(
                'No event found'
            );
        }
        return $this->render('book/index.html.twig', [
            'books' => $books
        ]);
    }


    /**
     * @Route("/show/{id}", name="show_book")
     *
     * @param Book $book
     *
     * @return Response
     */
    public function showBook(Book $book)
    {
        if (!$book) {
            throw $this->createNotFoundException(
                'No books found'
            );
        }
        return $this->render('book/show.html.twig', [
            'book' => $book
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit_book")
     *
     * @param Book $book
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function edit(Book $book, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($book);
            $em->flush();
            $this->addFlash('success', 'Edited');

            return $this->redirectToRoute('books');
        }
        return $this->render('book/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/create", name="create_book")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function createBook(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($book);
            $em->flush();
            $this->addFlash('success', 'a new book has been added');

            return $this->redirectToRoute('books');
        }
        return $this->render('book/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete_book")
     * @param Book $book
     * @return RedirectResponse
     */
    public function deleteBook(Book $book)
    {   $em = $this->getDoctrine()->getManager();
        if (!$book) {
            throw $this->createNotFoundException(
                'No books found'
            );
        }
        //dd($book);
        $em->remove($book);
        $em->flush();
        $this->addFlash('success', 'selected book has been deleted');
        return $this->redirectToRoute('books');
    }

}
