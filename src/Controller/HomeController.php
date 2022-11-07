<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {

        $faker = \Faker\Factory::create('fr_FR');

// dd($faker->name());



$posts = [];

for ($i = 0 ; $i < 10 ; $i++) {
    $post = new \StdClass();
    $post->title = $faker->sentence();
    $post->content = $faker->text(2000);
    $post->author = $faker->name();
    $post->image = 'https://picsum.photos/seed/post-'.$i.'/750/300';
    $post->createdAt = $faker->dateTimeBetween('-3 years', 'now', 'Europe/Paris');
 
    array_push($posts, $post);
 }
 
 


        return $this->render('home/index.html.twig', [
            'posts' => $posts
        ]);
    }
}
