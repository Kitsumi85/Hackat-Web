<?php

namespace App\Controller;

use App\Entity\Hackaton as EntityHackaton;
use App\Entity\Inscription;
use Doctrine\ORM\Mapping\Id;
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
        return $this->render('liste_des_hackaton/detail.html.twig', [
            'hackaton' => $hackaton,
            'inscrit' => $inscrit
        ]);
    }
    #[Route('inscription/{id}', name: 'app_inscription')]
    public function inscription(ManagerRegistry $doctrine, $id): Response
    {
        $repository = $doctrine->getRepository(EntityHackaton::class);
        $toutHackaton = $repository->findAll();
        $hackaton = $repository->find($id);
        $user = $this->getUser();
        $inscription = new Inscription();
        $inscription->setLeCompte($user);
        $inscription->setUnHackaton($hackaton);
        $inscription->setDateInsc(new \DateTime('now'));
        $entityManager = $doctrine->getManager();
        $entityManager->persist($inscription);
        $entityManager->flush();

        return $this->render('liste_des_hackaton/index.html.twig', [
            'controller_name' => 'ListeDesHackatonController',
            'hackaton' => $toutHackaton
        ]);
    }
}
