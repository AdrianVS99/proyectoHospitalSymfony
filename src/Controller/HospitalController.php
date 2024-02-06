<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HospitalController extends AbstractController
{
    #[Route('/hospital', name: 'app_hospital')]
    public function index(): Response
    {
        return $this->render('hospital/default.html.twig', 
        [
            'controller_name' => 'HospitalController',
        ]);
    }

    



}
