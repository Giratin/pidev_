<?php

namespace ExcursionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Tests\Extension\Core\Type\NumberTypeTest;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RandonneType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('capacite')
            ->add('daterando')
            ->add('destination', TextType::class, array('attr' =>array(
                'class' => 'form-control',
                'autofocus' => true,
                'placeholder' => 'Destination'
            )))
            ->add('prixpersonne')
            ->add('programme');
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
