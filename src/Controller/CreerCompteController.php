<?php

namespace App\Controller;
use App\Entity\Compte;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreerCompteController extends AbstractController
{
    #[Route('/CreerCompte', name: 'app_creer_compte')]
    public function index(ManagerRegistry $doctrine)
    {
        $compte = new Compte();
        $compte->setNom('Ne');
        $compte->setPrenom('Gui');
        $compte->setMel('nGui@gmail.com');
        $compte->setTel('0123456789');
        $compte->setDateNaissance(new \DateTime('d/m/y'));
        $compte->setPortfolioURL('https://portfolioHaz.fr');
        dump($compte);
        $entityManager = $doctrine->getManager();
        $entityManager->persist($compte);
        $entityManager->flush();
        return $this->render('creer_compte/CreerCompte.html.twig');
    }
}
