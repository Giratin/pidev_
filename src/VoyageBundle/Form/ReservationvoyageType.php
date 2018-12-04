<?php

namespace VoyageBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationvoyageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nbrePlaceReserv')
            ->add('nom')
            ->add('prenom')
            ->add('mail')
            ->add('prix')
            ->add('voyage',EntityType::class,array("class"=>"VoyageBundle\Entity\Voyage"
        ,"choice_label"=>'num',"multiple"  =>false  ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'VoyageBundle\Entity\Reservationvoyage'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'voyagebundle_reservationvoyage';
    }


}
