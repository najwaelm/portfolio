<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FrontController extends AbstractController
{



    #[Route('/home', name: 'home')]
    public function home(){
        return $this->render('front/home.html.twig');
    }

    #[Route('/about', name: 'about')]
    public function about(){
        return $this->render('front/about.html.twig');
    }


    #READ ALL
    #[Route('/shown/projects', name: 'shown_projects')]
    public function shown_projects(ProjectRepository $projectRepository): Response
    {
        $projects= $projectRepository->findAll();
        return $this->render('front/shown_projects.html.twig', [
            'projects'=> $projects,
        ]);
    }


}
