<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/notes', name: 'app_app.notes')]
    public function index(): Response
    {
        return $this->render('app/notes.html.twig');
    }
}
