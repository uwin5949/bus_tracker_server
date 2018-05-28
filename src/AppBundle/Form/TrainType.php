<?php
/**
 * Created by PhpStorm.
 * User: uwin5
 * Date: 05/27/18
 * Time: 7:12 PM
 */

namespace AppBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;

class TrainType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('trainName', TextType::class, array('required' => false, 'label' => 'Train Name'))
            ->add('startStation', EntityType::class, array(
                'required' => true,
                'label' => 'Start Station',
                'class' => 'AppBundle:TrainStation',
                'choice_label' => 'name'
            ))
            ->add('endStation', EntityType::class, array(
                'required' => true,
                'label' => 'End Station',
                'class' => 'AppBundle:TrainStation',
                'choice_label' => 'name'
            ))
            ->add('startTime',TimeType::class,array(
                'required'=>true,
                'label' => 'Start Time' ,
                'input'  => 'datetime',
                'widget' => 'choice'
            ))
            ->add('endTime',TimeType::class,array(
                'required'=>true,
                'label' => 'End Time' ,
                'input'  => 'datetime',
                'widget' => 'choice'
            ))
            ->add('availableDays')
            ->add('trainLines')
            ->add('save', SubmitType::class, array('label' => 'Save'));
    }




}