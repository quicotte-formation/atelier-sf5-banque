<?php

namespace App\Service;

use App\Entity\Journal;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class JournalService
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param EntityManagerInterface $em
     * @param LoggerInterface $logger
     */
    public function __construct(EntityManagerInterface $em, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }

    /**
     * Journalise ds entité journal et ds logger
     * @param $msg
     */
    public function journalise($msg){

        // Persiste en DB
        $j = new Journal();
        $j->setDateHeure(new \DateTime());
        $j->setMsg($msg);
        $this->em->persist( $j );
        $this->em->flush();

        // Utilise logger
        $this->logger->alert($msg);
    }
}