<?php

namespace App\Tests;

use App\Entity\Carte;
use App\Repository\CarteRepository;
use App\Repository\CompteRepository;
use App\Repository\OperationRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Flex\Unpack\Operation;

class RepoTest extends KernelTestCase
{
    /**
     * Fonction dispo ds rep: find, findOneBy, findBy, count, findAll
     * Créer fonctions de test suivantes
     * 1. testNbCartesOK
     * 2. testNbCartesEtatNonBloqueOK
     * 3. testCountCartesTypeDebitEtatNonBloqueOK
     * 4. testCountCartesTypeDebitDuCompte1OK
     * 5. testIdCompteCarte1OK
     * 6. testNbUtilCompte1OK ( à voir si ça fonctionne car rel ToMany )
     */

    public function testNbUtilCompte1OK(): void
    {
        $kernel = self::bootKernel();
        $rep = static::getContainer()->get(CompteRepository::class );
        self::assertEquals(2, count( $rep->find(1)->getUtilisateurs() )  );
    }
    /*
    public function testIdCompteCarte1OK(): void
    {
        $kernel = self::bootKernel();
        $rep = static::getContainer()->get(CompteRepository::class );
        self::assertEquals(1, $rep->findOneBy(['cartes'=>1]) );
    }*/
/*
    public function testCountCartesTypeDebitDuCompte1OK(): void
    {
        $kernel = self::bootKernel();
        $rep = static::getContainer()->get(CarteRepository::class );
        self::assertEquals(1, $rep->count(['type'=>Carte::TYPE_DEBIT, 'compte'=>1]) );
    }

    public function testCountCartesTypeDebitEtatNonBloqueOK(): void
    {
        $kernel = self::bootKernel();
        $rep = static::getContainer()->get(CarteRepository::class );
        self::assertEquals(0, $rep->count(['etatBloque'=>false, 'type'=>Carte::TYPE_DEBIT]) );
    }

    public function testNbCartesEtatNonBloqueOK(): void
    {
        $kernel = self::bootKernel();
        $rep = static::getContainer()->get(CarteRepository::class );
        self::assertEquals(2, count( $rep->findBy(['etatBloque'=>false]) ) );
    }

    public function testNbCartesOK(): void
    {
        $kernel = self::bootKernel();
        $rep = static::getContainer()->get(CarteRepository::class );
        self::assertEquals(3, count( $rep->findAll() ) );
    }
*/
}
