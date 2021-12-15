<?php

namespace App\DataFixtures;

use App\Entity\Carte;
use App\Entity\Compte;
use App\Entity\Utilisateur;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $utilisateur1 = new Utilisateur();
        $utilisateur1->setPseudo("util1")->setPassword("123456");
        $manager->persist($utilisateur1);

        $utilisateur2 = new Utilisateur();
        $utilisateur2->setPseudo("util2")->setPassword("123456");
        $manager->persist($utilisateur2);

        $utilisateur3 = new Utilisateur();
        $utilisateur3->setPseudo("util3")->setPassword("123456");
        $manager->persist($utilisateur3);


        $compte1 = new Compte();
        $compte1->setType(Compte::TYPE_NORMAL)->setSolde(1000);
        $compte1->addUtilisateur($utilisateur1);
        $compte1->addUtilisateur($utilisateur3);
        $manager->persist($compte1);

        $compte2 = new Compte();
        $compte2->setType(Compte::TYPE_NORMAL)->setSolde(1000);
        $manager->persist($compte2);

        $carte1 = new Carte();
        $carte1->setType(Carte::TYPE_CREDIT)->setCode(1234)->setEtatBloque(false)->setCompte($compte1)->setDateExpiration(new DateTime());
        $carte1->setUtilisateur($utilisateur1);
        $carte1->setCompte($compte1);
        $manager->persist($carte1);

        $carte2 = new Carte();
        $carte2->setType(Carte::TYPE_DEBIT)->setCode(1234)->setEtatBloque(false)->setCompte($compte2)->setDateExpiration(new DateTime());
        $carte2->setUtilisateur($utilisateur2);
        $carte2->setCompte($compte2);
        $manager->persist($carte2);

        $carte3 = new Carte();
        $carte3->setType(Carte::TYPE_CREDIT)->setCode(1234)->setEtatBloque(false)->setCompte($compte1)->setDateExpiration(new DateTime());
        $carte3->setUtilisateur($utilisateur3);
        $carte3->setCompte($compte1);
        $manager->persist($carte3);

        $manager->flush();

    }
}
