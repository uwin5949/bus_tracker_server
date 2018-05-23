<?php
/**
 * Created by PhpStorm.
 * User: uwin5
 * Date: 05/20/18
 * Time: 5:54 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class DriverAPIController extends BaseController
{

    /**
     * @Route("/driver/api/login", name="driver_login_api")
     */
    public function driverLoginAction(Request $request){
        if($request->getMethod() == 'POST'){
            $username=$request->get('username');
            $password = $request->get('password');
            $user = null;
            $stdResponse=new \stdClass();
            $stdResponse->status=400;
            $driver_role = $this->getRepository('Role')->findOneBy(array('metacode'=>'ROLE_DRIVER'));
            $user = $this->getRepository('User')->findOneBy(array('username'=>$username,'role'=>$driver_role));
            if($user != null){
                $encoder = $this->container->get('security.password_encoder');
                if($encoder->isPasswordValid($user, $password)){
                    $stdResponse->status=200;
                    $bus = $this->getRepository('Bus')->findOneBy(array('user'=>$user));
                    $stdResponse->busNo = $bus->getBusNo();
                    $stdResponse->busId = $bus->getId();
                    $stdResponse->username = $user->getUsername();
                    $stdResponse->route_id = $bus->getRoute()->getId();
                    $stdResponse->routeNo = $bus->getRoute()->getRouteNo();
                    $stdResponse->routeName = $bus->getRoute()->getRouteName();

                }
            }
            return new Response(json_encode($stdResponse));
        }
        else{
            return null;
        }



    }






}