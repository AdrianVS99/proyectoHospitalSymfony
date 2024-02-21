<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ServiciosControlerController extends AbstractController
{
    #[Route('/hospital/servicios', name: 'app_servicios_controler')]
    public function index(): Response
    {
        return $this->render('servicios_controler/index.html.twig', [
            'controller_name' => 'ServiciosControlerController',
        ]);
    }
}
