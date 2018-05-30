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
            $user = $this->getRepository('User')->findOneBy(array('username'=>$username));
            if($user != null && $user->getRole()->getMetacode()!='ROLE_ADMIN') {
                $encoder = $this->container->get('security.password_encoder');
                if ($encoder->isPasswordValid($user, $password)) {
                    $driver_role = $user->getRole()->getMetacode();
                    $stdResponse->status = 200;
                    $stdResponse->driverRole = $driver_role;
                    $stdResponse->username = $user->getUsername();
                    if ($driver_role == 'ROLE_DRIVER_TRAIN') {
                        $train = $this->getRepository('Train')->findOneBy(array('user' => $user));
                        $stdResponse->trainName = $train->getTrainName();
                        $stdResponse->trainId = $train->getId();

                        $startStation = new \stdClass();
                        $startStation->name = $train->getStartStation()->getName();
                        $startStation->id = $train->getStartStation()->getId();
                        $stdResponse->startStation = $startStation;

                        $endStation = new \stdClass();
                        $endStation->name = $train->getEndStation()->getName();
                        $endStation->id = $train->getEndStation()->getId();
                        $stdResponse->endStation = $endStation;

                        $trainLines = $train->getTrainLines();
                        $lineArray = [];
                        foreach ($trainLines as $line) {
                            $stdLine = new \stdClass();
                            $stdLine->name = $line->getName();
                            $stdLine->metacode = $line->getMetacode();
                            array_push($lineArray, $stdLine);
                        }
                        $stdResponse->trainLines = $lineArray;
                        $available_days = $train->getAvailableDays();
                        $availableDays = [];
                        foreach ($available_days as $day) {
                            $stdDay = new \stdClass();
                            $stdDay->name = $day->getDayName();
                            $stdDay->metacode = $day->getMetacode();
                            array_push($availableDays, $stdDay);
                        }
                        $stdResponse->availableDays = $availableDays;

                    }
                    elseif ($driver_role == 'ROLE_DRIVER'){
                        $bus = $this->getRepository('Bus')->findOneBy(array('user'=>$user));
                        $stdResponse->busNo = $bus->getBusNo();
                        $stdResponse->busId = $bus->getId();
                        $stdResponse->route_id = $bus->getRoute()->getId();
                        $stdResponse->routeNo = $bus->getRoute()->getRouteNo();
                        $stdResponse->routeName = $bus->getRoute()->getRouteName();
                    }
                }
            }
            return new Response(json_encode($stdResponse));
        }
        else{
            return null;
        }



    }






}