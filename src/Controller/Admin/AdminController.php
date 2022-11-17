<?php

namespace App\Controller\Admin;

use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{  
    #[Route('/admin', name: 'admin')]
    public function index(PostRepository $postRepository)
    {
       return $this->render('admin/index.html.twig', [
           'posts' => $postRepository->findBy([], ['createdAt' => 'DESC'])
       ]);
    }
    
}
