<?php

namespace App\Controller;

use App\Entity\Solicitudes;
use App\Form\SolicitudesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


class SolicitudesController extends AbstractController
{
    #[Route('/solicitudes', name: 'app_solicitudes')]
    public function citar( EntityManagerInterface $entityManager, Request $request)
    {
        $solicitud = new Solicitudes();
        $form = $this->createForm(SolicitudesType::class, $solicitud );
       
        $form->handleRequest( $request );

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($solicitud);
            $entityManager->flush();
         
            return new Response( "Solicitud enviada correctamente");
        }
        else
            return $this->render('solicitudes/index.html.twig', array('form' => $form->createView(),));
    }
}
