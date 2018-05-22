<?php
/**
 * Created by PhpStorm.
 * User: uwin5
 * Date: 05/20/18
 * Time: 7:43 PM
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RouteType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('routeName', TextType::class, array('required' => true, 'label' => 'Route Name'))
            ->add('routeNo', TextType::class, array('required' => true, 'label' => 'Route Number'))
            ->add('published', CheckboxType::class,array('required' => true, 'label' => false))
            ->add('coordinates', CollectionType::class, array(
                'entry_type' => CoordinateType::class,
                'allow_add'  => true,
                'by_reference' => false,
                'allow_delete' => true
            ))
            ->add('save', SubmitType::class, array('label' => 'Continue'));
    }

}