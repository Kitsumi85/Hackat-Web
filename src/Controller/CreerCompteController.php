<?php

namespace App\Controller;
use App\Entity\Compte;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreerCompteController extends AbstractController
{
    #[Route('/CreerCompte', name: 'CreerCompte')]
    public function index(ManagerRegistry $doctrine)
    {
        $compte = new Compte;
        $compte->setNom('Nez');
        $compte->setPrenom('Guer');
        $compte->setMel('nGuer@gmail.com');
        $compte->setTel('0123456789');
        $compte->setDateNaissance(new DateTime(1985-11-20));
        $compte->setPortfolioURL('https://portfolioHaz.fr');
        dump($compte);
        $entityManager = $doctrine->getManager();
        $entityManager->persist($compte);
        $entityManager->flush();
    }
}
