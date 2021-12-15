<?php

namespace App\Tests;

use App\DataFixtures\AppFixtures;
use App\Entity\Carte;
use App\Entity\Compte;
use App\Entity\Operation;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EMTest extends KernelTestCase
{
    protected function setUp(): void
    {
        echo "setUp";
        /*
        $kernel = self::bootKernel();
        $em = self::getContainer()->get(EntityManagerInterface::class);
        $fix = self::getContainer()->get( AppFixtures::class );
        $fix->
        $fix->load($em);
        */
    }

    /**
     * Créer des fonctions de test:
     * 1. verifTypeDuCompte1
     * 2. verifTypeDeCompteDeCarte1
     * 3. modifPseudoUtil1
     * 4. modifPseudoUtilDuCompte3
     * 5. removeCarteId2
     */

    public function testRemoveCarteId2()
    {
        echo "testRemoveCarteId2";
        $kernel = self::bootKernel();
        $em = self::getContainer()->get(EntityManagerInterface::class);

        $c = $em->find(Carte::class, 2);// SELECT

        $em->remove( $c );// DELETE
    }

    public function testModifPseudoUtilDuCompte3(){
        echo "testModifPseudoUtilDuCompte3";
        $kernel = self::bootKernel();
        $em = self::getContainer()->get(EntityManagerInterface::class);

        $cpt = $em->find(Compte::class, 3);
        $util = $cpt->getUtilisateurs()[0];
        $util->setPseudo('Modificado');
        $em->flush();
    }

    public function testModifPseudoUtil1(){
        echo "testModifPseudoUtil1";
        $kernel = self::bootKernel();
        $em = self::getContainer()->get(EntityManagerInterface::class);

        $u = $em->find(Utilisateur::class, 1);
        $u->setPseudo("Changed");
        $em->flush();
    }

    public function testVerifTypeDeCompteDeCarte1(){
        echo "testVerifTypeDeCompteDeCarte1";
        $kernel = self::bootKernel();
        $em = self::getContainer()->get(EntityManagerInterface::class);

        $carte1 = $em->find(Carte::class, 1);
        self::assertEquals( Compte::TYPE_NORMAL, $carte1->getCompte()->getType() );
    }

    public function testVerifTypeDuCompte1(){
        echo "testVerifTypeDuCompte1";
        $kernel = self::bootKernel();
        $em = self::getContainer()->get(EntityManagerInterface::class);

        $cpt = $em->find(Compte::TYPE_NORMAL, 1);
        self::assertEquals( Compte::TYPE_NORMAL, $cpt->getType() );
    }
}
