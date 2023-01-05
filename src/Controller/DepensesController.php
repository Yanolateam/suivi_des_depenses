<?php

namespace App\Controller;

use App\Entity\UserDepense;
use App\Form\DepenseFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/depenses', name: 'depenses_')]

class DepensesController extends AbstractController
{
    #[Route('/ajout', name: 'ajout')]

    public function add(
        EntityManagerInterface $em,
        Request $request
    ): Response
    {
        $depense = new UserDepense();
        $depenseform = $this->createForm(DepenseFormType::class, $depense);

        $depenseform->handleRequest($request);
        if ($depenseform->isSubmitted() && $depenseform->isValid()) {
            $em->persist($depense);
            $em->flush();

            $this->addFlash('success', 'Dépense ajouter');    
            return $this->redirectToRoute('profil_index');
        }

        return $this->render('depenses/index.html.twig', [
            'controller_name' => 'DepensesController',
            'depenseform' => $depenseform->createView(),
        ]);
    }
}
