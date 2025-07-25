<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Posts;
use App\Repository\PostsRepository;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PostsRepository $repository, Request $req): Response
    {
		$curPage = $req->query->getInt('page', 1);
		$limit = 8;

		$paginator = $repository->getAllPaginated($curPage, $limit);
		$totalPage = ceil($repository->getTotalPost() / $limit);
		$totalPost = $repository->getTotalPost();


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
			'page_name' => 'Beranda',
			'paginator' => $paginator,
			'total_page' => $totalPage,
			'cur_page' => $curPage,
			'limit' => $limit,
        ]);
    }
}
