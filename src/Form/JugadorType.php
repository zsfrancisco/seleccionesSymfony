<?php

namespace App\Form;

use App\Entity\Jugador;
use App\Entity\Equipo;
use App\Entity\Pais;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class JugadorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('edad')
            ->add('pais_jugador', EntityType::class,[
                'class' => Pais::class,
                'choice_label'=>'nombre_pais'
            ])
            ->add('equipo_jugador', EntityType::class,[
                'class' => Equipo::class,
                'choice_label'=>'nombre'
            ])
            ->add('agregar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Jugador::class,
        ]);
    }
}
