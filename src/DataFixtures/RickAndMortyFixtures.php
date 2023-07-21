<?php

namespace App\DataFixtures;

use App\Entity\Locations;
use App\Entity\RickAndMorty;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RickAndMortyFixtures extends Fixture
{

protected $httpClient;

    public function __construct(HttpClientInterface $httpClient){
     $this->httpClient = $httpClient;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
for ($i=0; $i<80; $i++){

$aleatorio = rand(1, 80);


$response = $this->httpClient->request("GET", "https://rickandmortyapi.com/api/character/$aleatorio");

$content = json_decode($response->getContent(), true);

$rickAndMorty = new RickAndMorty();
$rickAndMorty->setName($content["name"]);
$rickAndMorty->setStatus($content["status"]);
$rickAndMorty->setImage($content["image"]);

$manager->persist($rickAndMorty);
        $manager->flush();
    }
    }
}
