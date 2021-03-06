<?php

namespace ExcursionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('daterando')
            ->add('destination', TextType::class, array('attr' =>array(
                'class' => 'form-control',
                'autofocus' => true,
                'placeholder' => 'Destination'
            )))
            ->add('prixpersonne')
            ->add('programme')
            ->add('imgurl1', FileType::class, array('label'=>'Insert an image'))
            ->add('imgurl2', FileType::class, array('label'=>'Insert an image'))
            ->add('imgurl3', FileType::class, array('label'=>'Insert an image'))
        ;
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
