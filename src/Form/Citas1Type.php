<?php

namespace App\Form;

use App\Entity\Citas;
use App\Entity\Especialidad;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Citas1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('dni')
            ->add('direccion')
            ->add('telefono')
            ->add('email')
            ->add('info')
            ->add('especialidad', EntityType::class, [
                'class' => Especialidad::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Citas::class,
        ]);
    }
}
