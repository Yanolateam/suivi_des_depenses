<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserDepense;
use App\Form\DepenseFormType;
use App\Repository\UserDepenseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profil', name: 'profil_')]


class ProfilController extends AbstractController
{
    private $depenserepo;

    public function __construct(
        UserDepenseRepository $depenserepo
    ) {
        $this->depenserepo = $depenserepo;
    }

    #[Route('/{id}', name: 'index')]
    // Recupération des données dans les paramétres de la fonction exemple index(paramétres)
    public function index(User $user): Response
    {
        $userdepenses = $this->depenserepo->findAll(array('user' => $this->getUser()));

        return $this->render('profil/index.html.twig', [
            // Envoie des données à la vue 
            'user' => $user,
            'userdepenses' => $userdepenses,
        ]);
    }

    #[Route('/compte/{id}', name: 'infos')]

    public function infos(User $user): Response
    {
        return $this->render('infos_profil/index.html.twig', [
            'user' => $user,
            'controller_name' => 'InfosProfilController',
        ]);
    }

    #[Route('/depense/ajout', name: 'depense_ajout')]

    public function add(
        EntityManagerInterface $em,
        Request $request
    ): Response {
        $depense = new UserDepense();

        $user = $this->getUser();
        $depenseform = $this->createForm(DepenseFormType::class, $depense);
        $depense->setUser($this->getUser());
        $depenseform->handleRequest($request);
        if ($depenseform->isSubmitted() && $depenseform->isValid()) {
            $em->persist($depense);
            $em->flush();


            $this->addFlash('success', 'Dépense ajouter');
            return $this->redirectToRoute('profil_index', array(
                'id' => $user->getId()
            ));
        }

        return $this->render('depenses/index.html.twig', [
            'controller_name' => 'DepensesController',
            'depenseform' => $depenseform->createView(),
        ]);
    }
}
