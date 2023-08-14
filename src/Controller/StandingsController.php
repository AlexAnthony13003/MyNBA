<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StandingsController extends AbstractController
{
    #[Route('/standings', name: 'app_standings')]
    public function index(): Response
    {
        return $this->render('standings/index.html.twig');
    }
}
