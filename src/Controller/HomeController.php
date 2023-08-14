<?php

namespace App\Controller;

use App\Service\CallApiService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CallApiService $callApiService, PaginatorInterface $paginator, Request $request): Response
    {
        $matches = $callApiService->getMatchesForSeason(2018);

        $matchesByDate = [];
        foreach ($matches['data'] as $match) {
            $date = $match['date'];
            $matchesByDate[$date][] = $match;
        }

        krsort($matchesByDate); // Trie les dates de manière chronologique
        $pagination = $paginator->paginate(
            $matchesByDate,
            $request->query->getInt('page', 1), // Le numéro de la page actuelle
            5 // Le nombre d'éléments par page
        );

        return $this->render('home/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }
}

