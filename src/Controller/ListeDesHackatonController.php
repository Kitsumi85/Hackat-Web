<?php

namespace App\Controller;

use App\Entity\Hackaton as EntityHackaton;
use Doctrine\Persistence\ManagerRegistry;
use src\Entity\Hackaton;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeDesHackatonController extends AbstractController
{
    #[Route('hackaton', name: 'app_liste_des_hackaton')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(EntityHackaton::class);
        $hackaton = $repository->findAll();
        return $this->render('liste_des_hackaton/index.html.twig', [
            'controller_name' => 'ListeDesHackatonController',
            'hackaton' => $hackaton
        ]);
    }
    #[Route('accueil', name: 'app_accueil_hackathon')]
    public function accueilindex(): Response
    {
        return $this->render('accueil.html.twig', [
            'controller_name' => 'La page des hackathons',
            'text' => 'Bienvenue sur la page de présentation des hackathons'
        ]);
    }
}
