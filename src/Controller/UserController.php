<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
   #[Route('/signup', name: 'user.signup')]
   public function signup(Request $request, UserPasswordHasherInterface $hasher, EntityManagerInterface $manager): Response
{
    $user = new User();
   $form = $this->createForm(UserType::class, $user);
   $form->handleRequest($request);

   if ($form->isSubmitted() && $form->isValid()) {
   $plainPassword = $form->get('plainPassword')->getData();
   $hashedPassword = $hasher->hashPassword($user, $plainPassword);
   $user->setHash($hashedPassword);
   $manager->persist($user);
    $manager->flush();
    $this->addFlash('success', 'Votre compte est créé, connectez-vous.');


    return $this->redirectToRoute('security.login');
   }
    
//    

//     dd($user);
//  }
 

   return $this->render('user/signup.html.twig', [
       'form' => $form->createView()
   ]);
}



   
}

