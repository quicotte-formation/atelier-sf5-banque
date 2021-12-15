<?php

namespace App\Tests;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class QBTest extends KernelTestCase
{

    /**
     * Avec un QueryBuilder
     * 1. Sélectionner les utilisateur de la cartes d'id 1
     * 2. Sélectionner les cartes de l'utilisateur 'util'
     */
    public function testSomething(): void
    {
        $kernel = self::bootKernel();

        // Avec un repo
        $rep = static::getContainer()->get(UtilisateurRepository::class);
        $qb = $rep->createQueryBuilder("u");// SELECT u FROM App:Utilisateur u

        $qb->join("u.cartes", "c");
        $qb->where("c.solde>:MILLE");

        // QB -> Query
        $query = $qb->getQuery();
        $query->setParameter('MILLE', 1000);
        $utils = $query->getResult();
    }
}
