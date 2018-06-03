<?php

namespace AppBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JourneyForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('from', EntityType::class, array(
                'required' => true,
                'label' => false,
                'class' => 'AppBundle:City',
                'choice_label' => 'name'
            ))
            ->add('startTime',TimeType::class,array(
                'required'=>true,
                'label' => false ,
                'input'  => 'datetime',
                'widget' => 'choice'
            ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Journey'

        ));
    }

    public function getName()
    {
        return 'app_bundle_journey_form';
    }

}