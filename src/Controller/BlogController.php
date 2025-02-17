<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BlogController extends AbstractController
{
    #[Route('/', name: 'app_blog')]
    public function index(ArticleRepository $repo): Response
    {
        $articles = $repo->findAll('Titre de l\'article');

        return $this->render('blog/index.html.twig', [
            'controller_name' =>
                'BlogController',
            'articles' => $articles,
        ]);
    }

    #[Route('/blog', name: 'blog_home')]
    public function home($x = 10)
    {
        return $this->render('blog/home.html.twig', [
            'limit' => $x,
        ]);
    }
    #[Route('/blog/{id}', name: 'blog_show')]
    public function show($id, ArticleRepository $repo)
    {
        $article = $repo->find($id);

        return $this->render('blog/show.html.twig', ['article' => $article]);
    }
}
