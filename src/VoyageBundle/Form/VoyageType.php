<?php

namespace VoyageBundle\Form;

use Doctrine\DBAL\Types\TimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Time;

class VoyageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('destinationvoyage')
            ->add('datevoyagealler')
            ->add('hdepartvoyagealler')
            ->add('harriveevoyagealler')
            ->add('departvoyage')
            ->add('nbPlaceDispo')
            ->add('datevoyageretour')
            ->add('hdepartvoyageretour')
            ->add('harriveevoyageretour')
            ->add('prix')
            ->add('num')
            ->add('compagnie',ChoiceType::class,array('choices'=>array('Tunisair'=>"Tunisair","Nouvelair"=>"Nouvelair")))
            ->add('image',FileType::class,array('label'=>'insert image'));}
            /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'VoyageBundle\Entity\Voyage'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'voyagebundle_voyage';
    }


}
