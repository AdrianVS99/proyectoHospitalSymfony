<?php

namespace App\Controller;

use App\Entity\Especialidad;

use App\Entity\Medico;
use App\Entity\Citas;
use App\Form\CitasType;
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
        return $this->render('/hospital/index.html.twig', 
        [
            'controller_name' => 'HospitalController',
        ]);
    }

    #[Route('/hospital/cuadro_medico', name: 'app_cuadroMedico')]

    public function cuadroMedico(EntityManagerInterface $entityManager): Response
    {

        $especialidades = $entityManager->getRepository(Especialidad::class)->findAll();

        return $this->render('hospital/cuadromedico.html.twig', [
            'especialidades' => $especialidades,
        ]);
    }

    #[Route('/hospital/cuadro_medico/{id}', name: 'app_medicoEspecialidad')]
    public function medicoEspecialidad(EntityManagerInterface $entityManager,$id): Response
    {
           // Obtener la especialidad por su ID
           $especialidad = $entityManager->getRepository(Especialidad::class)->find($id);

           // Obtener los médicos asociados a esta especialidad
           $medicos = $especialidad->getMedicos();
   
           return $this->render('/hospital/medicos.html.twig', [
               'especialidad' => $especialidad,
               'medicos' => $medicos,
           ]);
          
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

    #[Route('/hospital/citas', name: 'app_citas')]

    public function citar( EntityManagerInterface $entityManager, Request $request)
    {
        $cita = new Citas();
        $form = $this->createForm(CitasType::class, $cita );
       
        $form->handleRequest( $request );

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cita);
            $entityManager->flush();
         
            return new Response( "Citado");
        }
        else
            return $this->render('hospital/citas.html.twig', array('form' => $form->createView(),));
    }
}
