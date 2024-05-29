<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class ErrorController extends AbstractController
{
    public function show404(): Response
    {
        return $this->render('error/error_404.html.twig', [], new Response('', 404));
    }
}

