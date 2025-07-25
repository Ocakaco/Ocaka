<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Posts;
use App\Repository\PostsRepository;

final class PostsController extends AbstractController
{
    #[Route('/posts', name: 'app_posts')]
    public function index(PostsRepository $repository, Request $req): Response
    {
		$curPage = $req->query->getInt('page', 1);
		$limit = 10;

		$paginator = $repository->getAllPaginated($curPage, $limit);
		$totalPage = ceil($repository->getTotalPost() / $limit);

        return $this->render('posts/index.html.twig', [
            'controller_name' => 'PostsController',
			'page_name' => 'Tulisan',
			'paginator' => $paginator,
			'total_page' => $totalPage,
			'cur_page' => $curPage,
			'limit' => $limit,
        ]);
    }

    #[Route('/posts/{id}', name: 'app_post_content')]
	public function content(EntityManagerInterface $entityManager, int $id): Response
	{
		$post = $entityManager->getRepository(Posts::class)->find($id);

		return $this->render('posts/content.html.twig', [
			'page_name' => 'Isi Tulisan',
			'post' => $post,
		]);
	}
}
