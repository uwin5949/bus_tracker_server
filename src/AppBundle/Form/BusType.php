<?php
/**
 * Created by PhpStorm.
 * User: dulit
 * Date: 10/14/2017
 * Time: 9:24 PM
 */

namespace AppBundle\Form;



use AppBundle\Repository\RouteRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('busName', TextType::class, array('required' => false, 'label' => 'Bus Name'))
            ->add('busNo', TextType::class, array('required' => true, 'label' => 'Plate Number'))
            ->add('route', EntityType::class, array(
                'required' => true, 'label' => 'Route',
                'class' => 'AppBundle:RoadRoute',
                'choice_label' => 'showName',
                'query_builder' => function (RouteRepository $r){
                    $query=$r->createQueryBuilder('r');
                    $query ->where('r.published=:true')
                        ->setParameter('true',true);
                    return $query;

                }
                ))
            ->add('published', CheckboxType::class,array('required' => true, 'label' => false))
            ->add('ownerType', EntityType::class, array(
                'required' => true, 'label' => 'Owner Type',
                'class' => 'AppBundle:OwnerType',
                'choice_label' => 'metacode'
            ))
            ->add('busType', EntityType::class, array(
                'required' => true, 'label' => 'Bus Type',
                'class' => 'AppBundle:BusType',
                'choice_label' => 'name'
            ))
            ->add('save', SubmitType::class, array('label' => 'Save'));
    }
}