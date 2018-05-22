<?php

namespace AppBundle\Controller;


use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{
    public function getRepository($entity){
        return $this->getDoctrine()->getRepository('AppBundle:'.$entity);
    }

    public function getEntityManager(){
        return $this->getDoctrine()->getManager();
    }

}