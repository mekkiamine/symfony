<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\AuthorRepository;

class AuthorController extends AbstractController
{
    private $AuthorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
       $this->AuthorRepository=$authorRepository;
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
            $authors=$this->AuthorRepository->findAllAuthors();

            return $this->render('author/list.html.twig', [
                'controller_name' => 'AuthorController',
                'authors' => $authors
            ]);
        
    }

    #[Route('/details/{id}', name: 'app_author_details')]
    public function AuthorDetails(int $id): Response
    {
        $author=$this->AuthorRepository->findDetail($id);
        
            return $this->render('author/author.html.twig', [
                'author' => $author
            ]);
    }
}
