<?php
/**
 * Created by PhpStorm.
 * User: uwin5
 * Date: 05/22/18
 * Time: 12:57 PM
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoordinateType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lat')
            ->add('long');

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\RouteCoordinate'

        ));
    }

    public function getName()
    {
        return 'app_bundle_coordinate_form';
    }



}