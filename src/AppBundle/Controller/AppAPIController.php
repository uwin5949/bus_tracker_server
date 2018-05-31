<?php
/**
 * Created by PhpStorm.
 * User: uwin5
 * Date: 05/22/18
 * Time: 3:24 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AppAPIController extends BaseController
{

    /**
     * @Route("/api/route/list", name="route_list_api")
     */
    public function routeListAPIAction(Request $request){
        if($request->getMethod() == 'POST'){

            $routes=$this->getRepository('RoadRoute')->findBy(array('published'=>true));
            $stdRoutes=array();
            for($i=0;$i<count($routes);$i++){
                $stdRoute=new \stdClass();
                $stdRoute->name=$routes[$i]->getRouteName();
                $stdRoute->id=$routes[$i]->getId();
                $stdRoute->routeNo=$routes[$i]->getRouteNo();
                array_push($stdRoutes,$stdRoute);
            }

            return new Response(json_encode($stdRoutes));
        }
        else{
            return null;
        }

    }

    /**
     * @Route("/api/bus/list", name="bus_list_api")
     */
    public function busListAPIAction(Request $request){
        if($request->getMethod() == 'POST'){
            $route_id = $request->get('route_id');
            $route=$this->getRepository('RoadRoute')->findOneBy(array('id'=>$route_id));
                $buses=$this->getRepository('Bus')->findBy(array('route'=>$route));
                $stdBuses=array();
                for($i=0;$i<count($buses);$i++){
                    $stdBus=new \stdClass();
                    $stdBus->name=$buses[$i]->getBusName();
                    $stdBus->id=$buses[$i]->getId();
                    $stdBus->busNo=$buses[$i]->getBusNo();
                    $stdBus->telNo = $buses[$i]->getTelNo();
                    $stdBus->ownerType=$buses[$i]->getOwnerType()->getMetacode();
                    $stdBus->busType=$buses[$i]->getBusType()->getMetacode();
                    $stdBus->username=$buses[$i]->getUser()->getUsername();
                    $stdBus->route_id=$buses[$i]->getRoute()->getId();
                    array_push($stdBuses,$stdBus);
                }


            return new Response(json_encode($stdBuses));
        }
        else{
            return null;
        }

    }

    /**
     * @Route("/api/coordinate/list", name="coordinate_list_api")
     */
    public function coordinateListAPIAction(Request $request){
        if($request->getMethod() == 'POST'){
            $route_id = $request->get('route_id');
            $route=$this->getRepository('RoadRoute')->findOneBy(array('published'=>true,'id'=>$route_id));
            $coordinates=$this->getRepository('RouteCoordinate')->findBy(array('route'=>$route));
            $stdCoordinates=array();
            for($i=0;$i<count($coordinates);$i++){
                $stdCoordinate=new \stdClass();
                $stdCoordinate->lat= (float) $coordinates[$i]->getLat();
                $stdCoordinate->lng= (float) $coordinates[$i]->getLong();
                array_push($stdCoordinates,$stdCoordinate);
            }


            return new Response(json_encode($stdCoordinates));
        }
        else{
            return null;
        }



    }


    /**
     * @Route("/api/train/list", name="train_list_api")
     */
    public function trainListAPIAction(Request $request){
        if($request->getMethod() == 'POST'){
            $line = $request->get('line');
            $trainLine=$this->getRepository('TrainLine')->findOneBy(array('metacode'=>$line));
            $trains=$this->getRepository('Train')->findTrainsOfLine($trainLine);
            $stdTrains=array();
            for($i=0;$i<count($trains);$i++){
                $stdTrain=new \stdClass();
                $stdTrain->id=$trains[$i]->getId();
                $stdTrain->name=$trains[$i]->getTrainName();
                $stdTrain->startStation = $trains[$i]->getStartStation()->getName();
                $stdTrain->endStation = $trains[$i]->getEndStation()->getName();
                $stdTrain->startTime = $trains[$i]->getStartTime()->format('H:i');
                $stdTrain->endTime = $trains[$i]->getEndTime()->format('H:i');
                $stdTrain->username = $trains[$i]->getUser()->getUsername();
                array_push($stdTrains,$stdTrain);


            }


            return new Response(json_encode($stdTrains));
        }
        else{
            return null;
        }

    }



}