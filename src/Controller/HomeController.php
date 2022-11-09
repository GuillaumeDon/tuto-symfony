<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'Home')]
    public function index(PostRepository $postRepository): Response
    {

        // $faker = \Faker\Factory::create('fr_FR');
        // $posts = $postRepository->findAll();
        $posts = $postRepository->findBy([], ['createdAt' => 'DESC']);

// dd($faker->name());
// dd($posts);



// $posts = [];

// for ($i = 0 ; $i < 10 ; $i++) {
//     $post = new \StdClass();
//     $post->title = $faker->sentence();
//     $post->content = $faker->text(2000);
//     $post->author = $faker->name();
//     $post->image = 'https://picsum.photos/seed/post-'.$i.'/750/300';
//     $post->createdAt = $faker->dateTimeBetween('-3 years', 'now', 'Europe/Paris');
 
//     array_push($posts, $post);
//  }
 
 


 return $this->render('home/index.html.twig', [
    'posts' => $posts
        ]);
    }
}
