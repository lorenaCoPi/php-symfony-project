<?php

namespace App\Controller;

use App\Entity\RickAndMorty;
use App\Entity\Locations;
use App\Form\RickAndMortyType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController {
    #[Route("/insert/user", name:"insertUser")]

    public function insertUser(EntityManagerInterface $doctrine, Request $request, UserPasswordHasherInterface $encriptado) {
    
        $form=$this->createForm(UserType::class);
        $form->handleRequest($request);
    
        if($form->isSubmitted()&& $form->isValid()){
            $user=$form->getData();
            $password= $user->getPassword();
            $passwordEncriptada=$encriptado->hashPassword($user, $password);
            $user->setPassword($passwordEncriptada);
    
            $doctrine->persist($user);
            $doctrine->flush();
            return $this->redirectToRoute("listCharacters");
        }
    
    return $this->render("RickAndMorty/insertRickMorty.html.twig", ["rickAndMortyForm"=>$form]);
    }

    #[Route("/insert/admin", name:"insertAdmin")]

    public function insertAdmin(EntityManagerInterface $doctrine, Request $request, UserPasswordHasherInterface $encriptado) {
    
        $form=$this->createForm(UserType::class);
        $form->handleRequest($request);
    
        if($form->isSubmitted()&& $form->isValid()){
            $user=$form->getData();
            $password= $user->getPassword();
            $passwordEncriptada=$encriptado->hashPassword($user, $password);
            $user->setPassword($passwordEncriptada);

            $user->setRoles(["ROLE_ADMIN", "ROLE_USER"]);
    
            $doctrine->persist($user);
            $doctrine->flush();
            return $this->redirectToRoute("listCharacters");
        }
    
    return $this->render("RickAndMorty/insertRickMorty.html.twig", ["rickAndMortyForm"=>$form]);
    }
}