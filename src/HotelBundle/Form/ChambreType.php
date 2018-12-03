<?php

namespace HotelBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChambreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('typechambre', ChoiceType::class, array('choices' => array('Single' => 'Single', 'Double' => 'Double')))
            ->add('numchambre')
            ->add('hotel',EntityType::class,array("class"=>"HotelBundle\Entity\Hotel","choice_label"=>'nameHotel',"multiple"=>false))
;    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HotelBundle\Entity\Chambre'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hotelbundle_chambre';
    }


}
