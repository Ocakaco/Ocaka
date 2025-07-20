<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PostContentController extends AbstractController
{
    #[Route('/post/content', name: 'app_post_content')]
    public function index(): Response
    {
        return $this->render('post_content/index.html.twig', [
            'controller_name' => 'PostContentController',
        ]);
    }
}
