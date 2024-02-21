<?php

namespace App\Form;

use App\Entity\Puesto;
use App\Entity\Solicitudes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class SolicitudesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('dni', null, [
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Length(['min' => 9, 'max' => 9]),
                new Assert\Regex(['pattern' => '/^\d{8}[A-Z]$/i', 'message' => 'El formato del DNI no es válido.']),
            ],
        ])
        ->add('telefono', null, [
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Length(['min' => 9, 'max' => 15]),
                new Assert\Regex(['pattern' => '/^\d+$/i', 'message' => 'El teléfono debe contener solo números.']),
            ],
        ])
        ->add('nombre')
        ->add('apellido1')
        ->add('apellido2')
        ->add('direccion')
        ->add('email')
        ->add('puesto', EntityType::class, [
            'class' => Puesto::class,
            'choice_label' => 'nombre',
            'multiple' => true,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Solicitudes::class,
        ]);
    }
}
