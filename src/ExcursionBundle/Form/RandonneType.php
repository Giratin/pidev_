<?php

namespace ExcursionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RandonneType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('capacite')
            ->add('nbreclient')
            ->add('daterando')
            ->add('destination')
            ->add('nbrebus')
            ->add('prixpersonne')
            ->add('programme')
            ->add('googlemaps');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ExcursionBundle\Entity\Randonne'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'excursionbundle_randonne';
    }


}
