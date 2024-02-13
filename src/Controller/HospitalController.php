<?php

namespace App\Controller;

use App\Entity\Especialidad;
use App\Entity\Medico;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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
        $especialidad = new Especialidad();
        foreach ($medico as $m) {
          $especialidad= $m->getEspecialidad();
         
        
        }

        return $this->render('hospital/cuadromedico.html.twig', [
            'medico' => $medico,
            'especialidad' => $especialidad

        ]);
    }

    #[Route('/hospital/cuadro_medico/{id}', name: 'app_medicoEspecialidad')]
    public function medicoEspecialidad(EntityManagerInterface $entityManager,$id): Response
    {

        $medico = new Medico();

        $medico = $medico->getEspecialidad();

        $especialidad = $entityManager->getRepository(Especialidad::class)->find($id);
        if (!$especialidad) {
            throw $this->createNotFoundException('Especialidad not found for id '.$id);
        }
        else
        {
        return $this->render('hospital/medicos.html.twig', [
            'especialidad' => $especialidad

        ]);
        }
    }


    
    #[Route('/hospital/inicio_sesion', name: 'app_inicio_sesion')]
    public function inicioSesion(AuthenticationUtils $authenticationUtils): Response
    {
      // get the login error if there is one
      $error = $authenticationUtils->getLastAuthenticationError();
  
      // last username entered by the user
      $lastUsername = $authenticationUtils->getLastUsername();
  
        return $this->render('hospital/inicio_sesion.html.twig', [
          'last_username' => $lastUsername,
          'error'         => $error,
        ]);
    }
}
