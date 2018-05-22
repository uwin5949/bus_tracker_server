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
                'required' => true, 'label' => 'RoadRoute',
                'class' => 'AppBundle:RoadRoute',
                'choice_label' => 'routeNo'.': '.'routeName',
                'query_builder' => function (RouteRepository $r){
                    $query=$r->createQueryBuilder('r');
                    $query ->where('r.published=:true')
                        ->setParameter('true',true);
                    return $query;

                }
                ))
            ->add('save', SubmitType::class, array('label' => 'Save'));
    }
}