<?php

namespace App\Controller;
use App\Entity\Compte;
use App\Form\CreerCompteType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CreerCompteController extends AbstractController
{
    #[Route('/CreerCompte', name: 'app_creer_compte')]
    public function index(ManagerRegistry $doctrine)
    {
        $compte = new Compte();
        $compte->setNom('bonjour');
        $compte->setPrenom('Gui');
        $compte->setMel('nGui@gmail.com');
        $compte->setTel('0123456789');
        $compte->setDateNaissance(new \DateTime('2000-08-15'));
        $compte->setPortfolioURL('https://portfolioHaz.fr');
        $compte->setPassword('');
        dump($compte);
        $entityManager = $doctrine->getManager();
        $entityManager->persist($compte);
        $entityManager->flush();
        return $this->render('creer_compte/CreerCompte.html.twig');
    }

    #[Route('/Creer_Compte_Form', name: 'form_creer_compte')]
    public function addCompte(Request $request, ManagerRegistry $doctrine): Response
    {
        $compte = new Compte();
        $form=$this->createForm(CreerCompteType::class, $compte);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()){
            $compte -> setPassword(password_hash($compte->getPassword(), PASSWORD_DEFAULT));
            $entityManager = $doctrine->getManager();
            $entityManager->persist($compte);
            $entityManager->flush();
            return $this->redirectToRoute('app_liste_des_hackaton');
        }
        return $this->render('creer_compte/CreerCompte.html.twig', [
            'controller_name' => 'CreerCompteController',
            'form' => $form->createView(),
        ]);
    }
}
