<?php

namespace App\Service;

use App\Entity\Compte;
use App\Repository\CompteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class CompteService
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var CompteRepository
     */
    private $cptRep;

    /**
     * @var JournalService
     */
    private $journalService;

    /**
     * @param EntityManagerInterface $em
     * @param CompteRepository $cptRep
     * @param JournalService $journalService
     */
    public function __construct(EntityManagerInterface $em, CompteRepository $cptRep, JournalService $journalService)
    {
        $this->em = $em;
        $this->cptRep = $cptRep;
        $this->journalService = $journalService;
    }


    /**
     * Récup 2 comptes S et D.
     * SI S possède pas solde nécessaire: -> Exception("Solde insuffisant")
     * débite S, crédite D
     * @param $idCptS
     * @param $idCptD
     * @param $montant
     */
    public function transferer($idCptS, $idCptD, $montant){

        // Récup 2 comptes
        $compteS = $this->cptRep->find($idCptS);
        $compteD = $this->cptRep->find($idCptD);

        // Validation
        if( $compteS->getSolde() < $montant ){
            throw new \Exception("Montant trop grand!");
        }

        // Débit / crédit / flush
        $compteS->setSolde( $compteS->getSolde()-$montant );
        $compteD->setSolde($compteD->getSolde()+$montant);

        $this->em->flush();

        // Journalise
        $this->journalService->journalise( sprintf("Transfert réussi cpt %d -> %d, montant:%f", $idCptD, $idCptD, $montant) );
    }

    /**
     * Exception("Montant limite atteint" si > 1500 € et compte non société)
     * Exception("Montant limit atteint pour société" si > 5000 € )
     * Exception("Solde insuffisant") si solde insuffisant ; )
     * Sinon débite cpte
     * @param $idCpt
     * @param $montant
     */
    public function retrait($idCpt, $montant){

        // Récup cpte
        $compte = $this->cptRep->find($idCpt);

        // Validation et exception si erreur
        if( $compte->getSolde() < $montant ){
            throw new \Exception("Solde insuffisant");
        }
        if( $compte->getType()==Compte::TYPE_NORMAL and $montant>1500){
            throw new \Exception("Montant limite atteint");
        }
        if( $compte->getType()==Compte::TYPE_SOCIETE and $montant>5000){
            throw new \Exception("Montant limite atteint");
        }

        // Débit + flush
        $compte->setSolde( $compte->getSolde()-$montant );
        $this->em->flush();

        // Journalisation
        $this->journalService->journalise( sprintf("Retrait réussi sur compte:%d montant:%f",$idCpt, $montant) );
    }
}