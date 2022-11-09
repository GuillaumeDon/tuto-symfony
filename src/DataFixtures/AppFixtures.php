<?php

namespace App\DataFixtures;

use App\Factory\PostFactory;
use App\Factory\CommentFactory;
use App\Factory\CategoryFactory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
       CategoryFactory::new()->createMany(5);
       PostFactory::new()->createMany(10);
       CommentFactory::new()->createMany(50);
       $manager->flush();
    }

    
}
