<?php

namespace App\Controller;

use App\Entity\Especialidad;
use App\Entity\Medico;
use Doctrine\ORM\EntityManagerInterface;
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

    #[Route('/hospital/cuadro_medico', name: 'app_cuadroMedico')]

    public function cuadroMedico(EntityManagerInterface $entityManager): Response
    {

        $medico = $entityManager->getRepository(Medico::class)->findAll();

        return $this->render('hospital/cuadromedico.html.twig', [
            'medico' => $medico

        ]);
    }
    
    #[Route('/hospital/inicio_sesion', name: 'app_inicio_sesion')]
    public function inicioSesion(): Response
    {
        return $this->render('hospital/inicio_sesion.html.twig', 
        [
            'controller_name' => 'HospitalController',
        ]);
    }
}
