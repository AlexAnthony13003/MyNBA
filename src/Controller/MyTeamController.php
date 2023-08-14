<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\CallApiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class MyTeamController extends AbstractController
{
    #[Route('/myteam', name: 'app_my_team')]
    #[IsGranted('ROLE_USER')]
    public function myTeam(CallApiService $callApiService): Response
    {
        $teams = $callApiService->getTeams();
        $colorList = ["#C2BECC", "#187506", "#414241", "#16CFD2", "#E90F0F", "#A43028", "#2B4BCA", "#CAC52B", "#CA2B2B"
            , "#C4F400", "#F40000", "#DAE311", "#DBDBD6", "#7619D3", "#48519C", "#E40D2A", "#0A7E0F", "#2525B1"
            , "#768A04", "#F9A41F", "#0026E1", "#5B74EB", "#9E223E", "#D59C10", "#D51610", "#BD10D5", "#BCB9B9"
            , "#F40000", "#501EBB", "#DE1313"];

        return $this->render('my_team/index.html.twig', [
            'teams' => $teams,
            'colorList' => $colorList,
        ]);
    }

    #[Route('/myteam/{id}', name: 'app_my_team.team_details')]
    #[IsGranted('ROLE_USER')]
    public function teamDetails(CallApiService $callApiService, $id, EntityManagerInterface $entityManager): Response
    {
        $teamDetails = $callApiService->getSpecificTeam($id);
        $user = $this->getUser();
        if ($user instanceof User) {
            $user->setIdFavoriteTeam($id);
            $entityManager->persist($user);
            $entityManager->flush();

        }


        return $this->render('my_team/team_details.html.twig', [
            'teamDetails' => $teamDetails,
        ]);
    }
}
