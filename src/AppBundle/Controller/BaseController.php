<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends Controller
{
    public function getRepository($entity){
        return $this->getDoctrine()->getRepository('AppBundle:'.$entity);
    }

    public function getEntityManager(){
        return $this->getDoctrine()->getManager();
    }
}