<?php

namespace App\Controller;

use App\Entity\RickAndMorty;
use App\Entity\Locations;
use App\Form\RickAndMortyType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class RickAndMortyController extends AbstractController {

    #[Route("/", name:"home")]
    public function home()
    {
        return $this->render("RickAndMorty/homeRickMorty.html.twig");
    }

#[Route("/character/{id}", name:"getCharacter")]

public function getCharacter(EntityManagerInterface $doctrine, $id){

    $repository=$doctrine->getRepository(RickAndMorty::class);

    $character = $repository->find($id);

return $this->render("RickAndMorty/rickMorty.html.twig", ["character"=>$character]);
}

#[Route("/new/character")]
public function newCharacter(EntityManagerInterface $doctrine){
    $rickAndMorty1 = new RickAndMorty();

$rickAndMorty1->setName("Rick Sánchez");
$rickAndMorty1->setStatus("Alive");
$rickAndMorty1->setImage("https://rickandmortyapi.com/api/character/avatar/1.jpeg");

$rickAndMorty2 = new RickAndMorty();

$rickAndMorty2->setName("Morty Smith");
$rickAndMorty2->setStatus("Alive");
$rickAndMorty2->setImage("https://rickandmortyapi.com/api/character/avatar/2.jpeg");

$rickAndMorty3 = new RickAndMorty();

$rickAndMorty3->setName("Summer Smith");
$rickAndMorty3->setStatus("Alive");
$rickAndMorty3->setImage("https://rickandmortyapi.com/api/character/avatar/3.jpeg");

$rickAndMorty4 = new RickAndMorty();

$rickAndMorty4->setName("Beth Smith");
$rickAndMorty4->setStatus("Alive");
$rickAndMorty4->setImage("https://rickandmortyapi.com/api/character/avatar/4.jpeg");

$rickAndMorty5 = new RickAndMorty();

$rickAndMorty5->setName("Jerry Smith");
$rickAndMorty5->setStatus("Alive");
$rickAndMorty5->setImage("https://rickandmortyapi.com/api/character/avatar/5.jpeg");

$location1 = new Locations();
$location1->setName("Earth");

$location2 = new Locations();
$location2->setName("Citadel of Ricks");

$location3 = new Locations();
$location3->setName("Abadango");

$location4 = new Locations();
$location4->setName("Testicle Monster Dimension");

$location5 = new Locations();
$location5->setName("Worldender's lair");

$rickAndMorty1->addLocation($location2);
$rickAndMorty2->addLocation($location1);
$rickAndMorty3->addLocation($location1);
$rickAndMorty4->addLocation($location1);
$rickAndMorty5->addLocation($location1);

$doctrine->persist($rickAndMorty1);
$doctrine->persist($rickAndMorty2);
$doctrine->persist($rickAndMorty3);
$doctrine->persist($rickAndMorty4);
$doctrine->persist($rickAndMorty5);
$doctrine->persist($location1);
$doctrine->persist($location2);
$doctrine->persist($location3);
$doctrine->persist($location4);
$doctrine->persist($location5);

$doctrine->flush();

    return new Response("Nuevo personaje creado");

}


#[Route("/characterlist", name:"listCharacters")]

public function listCharacters(EntityManagerInterface $doctrine) {

    $repository= $doctrine->getRepository(RickAndMorty::class);

$rickAndMorty=$repository->findAll();

    return $this->render("RickAndMorty/listRickMorty.html.twig",["rickAndMorty"=>$rickAndMorty]);
}

#[Route("/insert/character", name:"insertCharacter")]

public function insertCharacter(EntityManagerInterface $doctrine, Request $request) {

    $form=$this->createForm(RickAndMortyType::class);
    $form->handleRequest($request);

    if($form->isSubmitted()&& $form->isValid()){
        $rickAndMorty=$form->getData();

        $doctrine->persist($rickAndMorty);
        $doctrine->flush();
        return $this->redirectToRoute("listCharacters");
    }

return $this->render("RickAndMorty/insertRickMorty.html.twig", ["rickAndMortyForm"=>$form]);
}

#[Route("/edit/character/{id}", name:"editCharacter")]

#[IsGranted("ROLE_ADMIN")]

public function editCharacter(EntityManagerInterface $doctrine, Request $request, $id) {

   $repository = $doctrine->getRepository(RickAndMorty::class);
   $rickAndMorty = $repository->find($id);

    $form=$this->createForm(RickAndMortyType::class, $rickAndMorty);
    $form->handleRequest($request);

    if($form->isSubmitted()&& $form->isValid()){
        $rickAndMorty=$form->getData();
        $doctrine->persist($rickAndMorty);
        $doctrine->flush();
        return $this->redirectToRoute("listCharacters");
    }

return $this->render("RickAndMorty/insertRickMorty.html.twig", ["rickAndMortyForm"=>$form]);
}

}