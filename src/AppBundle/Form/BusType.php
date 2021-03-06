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
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('busName', TextType::class, array('required' => false, 'label' => 'Bus Name'))
            ->add('busNo', TextType::class, array('required' => true, 'label' => 'Plate Number'))
            ->add('telNo', TextType::class, array('required' => true, 'label' => 'Telephone Number'))
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
            ->add('journeys', CollectionType::class, array(
                'entry_type' => JourneyForm::class,
                'allow_add'  => true,
                'by_reference' => false,
                'allow_delete' => true
            ))
            ->add('save', SubmitType::class, array('label' => 'Save'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Bus',

        ));
    }
    public function getName()
    {
        return 'app_bundle_bus_form';
    }


}