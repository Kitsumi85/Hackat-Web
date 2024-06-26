<?php

namespace App\Controller;

use App\Entity\Favorie;
use App\Entity\Hackaton as EntityHackaton;
use App\Entity\Inscription;
use App\Entity\Favoris;
use DateTime;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    
    #[Route('mes-hackaton', name: 'app_liste_de_mes_hackaton')]
    public function mesHackaton(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(EntityHackaton::class);
        $user = $this->getUser();
        $mesHackaton = $repository->find($user);         
        return $this->render('liste_des_hackaton/inscritHackat.html.twig', [
            'controller_name' => 'ListeDesHackatonController',
            'hackaton' => $mesHackaton
        ]);
    }

    #[route('hackathon/{id}/favorite', name: 'app_favorite')]
    public function getFavorite($id, ManagerRegistry $doctrine)
    {
        $repository = $doctrine->getRepository(EntityHackaton::class);
        $hackaton = $repository->find($id);
        dump($hackaton);
        $user = $this->getUser();
        dump($user);
        $favorite = new Favoris();
        $favorite->setIdCompte($user);
        $favorite->setIdHackathon($hackaton);
        $favorite->setIsFavori(true);
        dump($favorite);
        $entityManager = $doctrine->getManager();
        $entityManager->persist($favorite);
        $entityManager->flush();
        $data = [
            'favorite' => $favorite->isIsFavori()
        ];

        return new JsonResponse($data);
    }
}
