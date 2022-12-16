<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InfosProfilController extends AbstractController
{
    #[Route('/infos/profil', name: 'app_infos_profil')]
    public function index(): Response
    {
        return $this->render('infos_profil/index.html.twig', [
            'controller_name' => 'InfosProfilController',
        ]);
    }
}
