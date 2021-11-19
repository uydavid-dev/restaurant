<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Produit;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();

        $user->setEmail('user@test.com')
             ->setPrenom('user')
             ->setNom('test')
             ->setTelephone('0102456520');

        $password = $this->encoder->encodePassword($user, 'admin');
        $user->setPassword($password);


        $manager->persist($user);

            // Categorie de test
    $categorie = new Categorie();

    $categorie->setNom('plats')
              ->setDescription('salad')
              ->setSlug('plats');

    $manager->persist($categorie);

    for ($j=0; $j <2; $j++) {

        $produit = new Produit();

        $produit->setNom('pokebowl')
             ->setCommander('true')
             ->setNom('test')
             ->setSlug('test')
             ->setFile('placeholder.jpg')
             ->addCategorie($categorie)
             ->setPrix('10')
             ->setUser($user);


        $manager->persist($produit);

        
    }



    // Categorie de test
    $categorie = new Categorie();

    $categorie->setNom('plats')
              ->setDescription('salad')
              ->setSlug('plats');

    $manager->persist($categorie);

    $produit = new Produit();

    $produit->setNom('pokebowl')
         ->setCommander('true')
         ->setNom('test')
         ->setSlug('test')
         ->setFile('placeholder.jpg')
         ->addCategorie($categorie)
         ->setPrix('10')
         ->setUser($user);


    $manager->persist($produit);

    $manager->flush();

        
    }
}
