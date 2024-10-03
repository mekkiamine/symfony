<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController
{
    private array $authors;

    public function __construct()
    {
        $this->authors = array(
            array('id' => 1, 'picture' => 'Victor-Hugo.jpeg', 'username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com', 'nb_books' => 100),
            array('id' => 2, 'picture' => 'william-shakespeare.jpeg', 'username' => 'William Shakespeare', 'email' => 'william.shakespeare@gmail.com', 'nb_books' => 200),
            array('id' => 3, 'picture' => 'Taha_Hussein.jpeg', 'username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
        );
    }

    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/showAuthor/{name}', name: 'app_ShowAuthor')]
    public function showAuthor(string $name): Response
    {   
        return $this->render('author/show.html.twig', [
            'name' => $name,
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/ListAuthors', name: 'app_ListAuthors')]
    public function ListAuthors(): Response
    {
        
            return $this->render('author/list.html.twig', [
                'controller_name' => 'AuthorController',
                'authors' => $this->authors
            ]);
        
    }

    #[Route('/details/{id}', name: 'app_author_details')]
    public function AuthorDetails(int $id): Response
    {
        $index = $id - 1;

        if (isset($this->authors[$index])) {
            $author = $this->authors[$index];
    
            return $this->render('author/author.html.twig', [
                'author' => $author
            ]);
        } else {
            return new Response("Author not found", 404);
        }
    }
}
