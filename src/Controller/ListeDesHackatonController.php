<?php

namespace App\Controller;

use App\Entity\Hackaton as EntityHackaton;
use App\Entity\Inscription;
use Doctrine\Persistence\ManagerRegistry;
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
        foreach($hackaton as $unHackaton){
            $dateLimit = $repository->GetDateLimit($unHackaton->getId());
            $unHackaton->setDateLimInsc(new DateTime($dateLimit['Datelimite']));
            
        }
        return $this->render('liste_des_hackaton/index.html.twig', [
            'controller_name' => 'ListeDesHackatonController',
            'hackaton' => $hackaton
        ]);
    }
    #[Route('/', name: 'app_accueil_hackathon')]
    public function accueilindex(): Response
    {
        return $this->render('accueil.html.twig', [
            'controller_name' => 'La page des hackathons',
            'text' => 'Bienvenue sur la page de présentation des hackathons'
        ]);
    }
    #[Route('detailHackaton/{id}', name: 'app_detail_des_hackaton')]
    public function detail(ManagerRegistry $doctrine, $id): Response
    {
        $repository = $doctrine->getRepository(EntityHackaton::class);
        $repository2 = $doctrine->getRepository(Inscription::class);
        $user = $this->getUser();

        $inscrit = $repository2->findOneBy(
            ['UnHackaton' => $id,
            'leCompte' => $user]);
        $hackaton = $repository->find($id);
        $dateLimit = $repository->GetDateLimit($hackaton->getId());
        $hackaton->setDateLimInsc(new DateTime($dateLimit['Datelimite']));
        return $this->render('liste_des_hackaton/detail.html.twig', [
            'hackaton' => $hackaton,
            'inscrit' => $inscrit
        ]);
    }
}
