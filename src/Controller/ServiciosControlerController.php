<?php

namespace App\Controller;

use App\Entity\Informacion;
use App\Entity\Servicios;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;


class ServiciosControlerController extends AbstractController
{
    #[Route('/hospital/servicios', name: 'app_servicios_controler')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $servicios = $entityManager->getRepository(Servicios::class)->findAll();

        return $this->render('servicios_controler/index.html.twig', [
            'servicios' => $servicios,
        ]);
    }

    #[Route('/hospital/informacion/{id}', name: 'app_servicios_informacion')]
    public function medicoEspecialidad(EntityManagerInterface $entityManager,$id): Response
    {
           // Obtener la especialidad por su ID
           $info = $entityManager->getRepository(Informacion::class)->findOneBy(['servicio' => $id]);
       
   
           return $this->render('/servicios_controler/informacion.html.twig', [
              'servicio' => $info
         
           ]);
          
    }
}
