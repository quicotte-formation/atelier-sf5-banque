<?php

namespace App\Tests;

use App\Entity\Carte;
use App\Entity\Compte;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * 1. lister comptes de l'utilisateur nommé 'Tom'
 * 2. les utilisateurs de la carte d'id 1
 * 3. les operations initiées par la carte d'id 2
 * 4. les cartes relatives à l'utilisateur 'Tom'
 * AVEC SOUS-REQUETES:
 * 5. DIFFERENCE : les utilisateurs dont le pseudo contient le mot 'tom' mais ne possédant pas de compte Société
 * 6. INTERSECTION : les comptes liés à des cartes de credit et à des utils dont le pseudo contient le mot 'tom'
 * 7. UNION: les cartes de crédit bloquées liées aux comptes privées ET les cartes de débit non-bloquées des comptes
 * SOCIETE
 * AVEC GROUP BY / HAVING: ( on va select des champs et pas des entités complètes, ensuite var_dump ; )
 * 8. Le pseudo et nombre de cartes de chaque utilisateur
 * 9. Le pseudo et nombre d'opérations de chaque utilisateur ( ! également tous ceux n'ayant réalisé aucune op )
 * 10. L'id de chaque carte et le total d'utilisateurs associés à cette carte, uniquement si total>1
 */
class QueryTest extends KernelTestCase
{
    /**
     *  INTERSECTION : les comptes liés à des cartes de credit et à des utils dont le pseudo contient le mot 'tom
     */
    public function test6(): void
    {
        $kernel = self::bootKernel();
        $em = static::getContainer()->get(EntityManagerInterface::class);
        $dql = "SELECT  DISTINCT c.id
                FROM    App:Compte c 
                        JOIN c.cartes ca 
                WHERE   ca.type=:TYPE 
                        AND c IN (
                        SELECT  c2
                        FROM    App:Compte c2
                                JOIN c2.utilisateurs u2
                        WHERE   u2.pseudo LIKE '%user%'
                        )";
        $query = $em->createQuery( $dql );
        $query->setParameter( 'TYPE', Carte::TYPE_CREDIT );
        $comptes = $query->getResult();

        var_dump($comptes);

        self::assertTrue(true);
    }
}
