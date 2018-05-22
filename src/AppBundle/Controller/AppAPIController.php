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

}