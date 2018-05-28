<?php
/**
 * Created by PhpStorm.
 * User: uwin5
 * Date: 05/28/18
 * Time: 8:24 AM
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TrainStationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('required' => true, 'label' => 'Name'))
            ->add('save', SubmitType::class, array('label' => 'Continue'));
    }



}