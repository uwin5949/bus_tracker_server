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
            $json_data=json_decode($request->getContent());
            $username=$json_data->username;
            $password = $json_data->password;
            $user = null;
            $stdResponse=new \stdClass();
            $stdResponse->status=400;
            $driver_role = $this->getRepository('Role')->findOneBy(array('metacode'=>'ROLE_DRIVER'));
            $user = $this->getRepository('User')->findOneBy(array('username'=>$username,'role'=>$driver_role));
            if($user != null){
                $encoder = $this->container->get('security.password_encoder');
                if($encoder->isPasswordValid($user, $password)){
                    $stdResponse->status=200;
                }
            }
            return new Response(json_encode($stdResponse));
        }
        else{
            return null;
        }



    }






}