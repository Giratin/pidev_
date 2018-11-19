<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('prenom', TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('username',TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('email', TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('mobile', TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('addresse', TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('codePostal', TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('pays', TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('password', TextType::class, array('attr' => array('class'=>'form-control')));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix()
    {
        return 'userbundle_user';
    }






}
