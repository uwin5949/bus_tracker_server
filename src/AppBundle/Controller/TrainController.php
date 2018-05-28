<?php
/**
 * Created by PhpStorm.
 * User: uwin5
 * Date: 05/27/18
 * Time: 7:11 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Train;
use AppBundle\Entity\TrainStation;
use AppBundle\Entity\User;
use AppBundle\Form\TrainStationType;
use AppBundle\Form\TrainType;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class TrainController extends BaseController
{


    /**
     * @Route("/dashboard/train/configure/{id}", name="dashboard_train_configure")
     */
    public function tarinConfigureAction(Request $request,$id=null)
    {
        $isEdit=null;
        if($id==null){
            $train=new Train();
            $train_user = new User();
            $driver_role = $this->getRepository('Role')->findOneBy(array('metacode'=>'ROLE_DRIVER_TRAIN'));
            $train_user->setRole($driver_role);
            $train->setUser($train_user);
            $isEdit=false;
        }
        else{
            $train = $this->getRepository('Train')->find($id);
            $train_user=$train->getUser();
            $isEdit=true;
        }
        if($train==null){
            return null;
        }
        $form = $this->createForm(TrainType::class, $train);
        $form->handleRequest($request);
        $errors = $form->getErrors();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();

            if(!$isEdit){
                $trainDrivers = $this->getRepository('User')->findBy(array('role'=>$driver_role));
                $username = "trainuser".(string)(count($trainDrivers)+1);
                $train_user->setRole($driver_role);
                $train_user->setUsername($username);
                $train_user->setName($train->getTrainName());
                $encoder = $this->container->get('security.password_encoder');
                $encoded = $encoder->encodePassword($train_user, "driver@train");
                $train_user->setPassword($encoded);
                try{
                    $em->persist($train_user);
                    $em->flush();
                }
                catch(Exception $e){
                    $this->addFlash(
                        'error',
                        'Train already exists !!!'
                    );
                    return $this->redirectToRoute('dashboard_train_configure');
                }

            }

            $em->persist($train);
            $em->flush();
            if($isEdit){
                $this->addFlash(
                    'success',
                    'Train Has been Updated Successfully!'
                );
            }
            else{
                $this->addFlash(
                    'success',
                    'Train Has been Added Successfully!'
                );
            }
            return $this->redirectToRoute('dashboard_train_configure',array('id'=>$train->getId()));
        }

        return $this->render('dashboard/trainConfigure.html.twig', array(
            'heading' => 'Train Configure',
            'errors' => $errors,
            'isEdit'=>$isEdit,
            'form' => $form->createView(),
            'bus_user'=>$train_user
        ));
    }



    /**
     * @Route("/dashboard/train/list", name="dashboard_view_train_list")
     */
    public function viewTrainListAction(Request $request)
    {

        $trainLines=$this->getRepository('TrainLine')->findAll();

        $trains = $this->getRepository('Train')->findTrainsOfLine($trainLines[0]);


        return $this->render('dashboard/trainList.html.twig', array(
            'trains' => $trains,
            'trainLines'=>$trainLines,
            'heading' => 'Train List',
        ));
    }


    /**
     * @Route("/dashboard/trainStation/configure/{id}", name="dashboard_trainStation_configure")
     */
    public function tarinStationConfigureAction(Request $request,$id=null)
    {
        $isEdit=null;
        if($id==null){
            $trainStation=new TrainStation();
            $isEdit=false;
        }
        else{
            $trainStation = $this->getRepository('TrainStation')->find($id);
            $isEdit=true;
        }
        if($trainStation==null){
            return null;
        }
        $form = $this->createForm(TrainStationType::class, $trainStation);
        $form->handleRequest($request);
        $errors = $form->getErrors();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();


            $em->persist($trainStation);
            $em->flush();
            if($isEdit){
                $this->addFlash(
                    'success',
                    'Train Station Has been Updated Successfully!'
                );
            }
            else{
                $this->addFlash(
                    'success',
                    'Train Station Has been Added Successfully!'
                );
            }
            return $this->redirectToRoute('dashboard_trainStation_configure',array('id'=>$trainStation->getId()));
        }

        return $this->render('dashboard/trainStationConfigure.html.twig', array(
            'heading' => 'Train Configure',
            'errors' => $errors,
            'isEdit'=>$isEdit,
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("/dashboard/trainStation/list", name="dashboard_view_trainStation_list")
     */
    public function viewTrainStationListAction(Request $request)
    {

        $trainStations=$this->getRepository('TrainStation')->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $trainStations, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );


        return $this->render('dashboard/trainStationList.html.twig', array(
            'heading' => 'Train Station List',
            'pagination'=>$pagination
        ));
    }


    /**
     * @Route("/dashboard/trainLine/list", name="dashboard_view_trainLine_list")
     */
    public function viewTrainLineListAction(Request $request)
    {

        $trainLiness=$this->getRepository('TrainLine')->findAll();

        return $this->render('dashboard/trainLineList.html.twig', array(
            'heading' => 'Train Line List',
            'trainLines'=>$trainLiness,
        ));
    }


    /**
     * @Route("/dashboard/train/list/ajax/load/data", name="dashboard_train_list_ajax_load_data")
     */
    public function trainLoadAjaxAction(Request $request)
    {
        $data=json_decode($request->get('data'));
        $line=$this->getRepository('TrainLine')->find($data->line);
        $trains=$this->getRepository('Train')->findTrainsOfLine($line);
        $stdTrains=array();
        for($i=0;$i<count($trains);$i++){
            $stdTrain=new \stdClass();
            $stdTrain->id=$trains[$i]->getId();
            $stdTrain->name=$trains[$i]->getTrainName();
            $stdTrain->startStation = $trains[$i]->getStartStation()->getName();
            $stdTrain->endStation = $trains[$i]->getEndStation()->getName();
            $stdTrain->startTime = $trains[$i]->getStartTime()->format('H:i');
            $stdTrain->endTime = $trains[$i]->getEndTime()->format('H:i');
            array_push($stdTrains,$stdTrain);


        }

        return new Response(json_encode($stdTrains),200);
    }




}