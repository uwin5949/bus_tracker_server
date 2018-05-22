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
            $route=$this->getRepository('RoadRoute')->findOneBy(array('published'=>true,'id'=>$route_id));
                $buses=$this->getRepository('Bus')->findBy(array('route'=>$route,'published'=>true));
                $stdBuses=array();
                for($i=0;$i<count($buses);$i++){
                    $stdBus=new \stdClass();
                    $stdBus->name=$buses[$i]->getBusName();
                    $stdBus->id=$buses[$i]->getId();
                    $stdBus->routeNo=$buses[$i]->getBusNo();
                    $stdBus->ownerType=$buses[$i]->getOwnerType()->getMetacode();
                    $stdBus->busType=$buses[$i]->getBusType()->getMetacode();
                    array_push($stdBuses,$stdBus);
                }


            return new Response(json_encode($stdBuses));
        }
        else{
            return null;
        }



    }

}