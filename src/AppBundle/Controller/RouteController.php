<?php
/**
 * Created by PhpStorm.
 * User: uwin5
 * Date: 05/22/18
 * Time: 12:51 PM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\RoadRoute;
use AppBundle\Entity\RouteCoordinate;
use AppBundle\Form\RouteType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RouteController extends BaseController
{

    /**
     * @Route("/dashboard/route/configure/{id}", name="dashboard_route_configure")
     */
    public function routeConfigureAction(Request $request,$id=null)
    {
        $isEdit=null;
        if($id==null){
            $route=new RoadRoute();
            $isEdit=false;
        }
        else{
            $route = $this->getRepository('RoadRoute')->find($id);
            $isEdit=true;
        }
        if($route==null){
            $route=new RoadRoute();
            $isEdit=false;
        }

        if(!$isEdit){
            $originalCoordinates = new ArrayCollection();

            foreach ($route->getCoordinates() as $coordinate) {
                $originalCoordinates->add($coordinate);
            }
            $tempCoordinate = new RouteCoordinate();
            $route->addCoordinate($tempCoordinate);
        }


        $form = $this->createForm(RouteType::class, $route);
        if($isEdit){
            $form->remove('coordinates');
        }
        $form->handleRequest($request);
        $errors = $form->getErrors();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            if(!$isEdit){
                foreach ($originalCoordinates as $coordinate) {
                    if (false === $route->getCoordinates()->contains($coordinate)) {
                        $em->remove($coordinate);
                    }
                }
                foreach ($route->getCoordinates() as $coordinate) {
                    $coordinate->setRoute($route);
                }
            }

            $em->persist($route);
            $em->flush();
            if($isEdit){
                $this->addFlash(
                    'success',
                    'RoadRoute Has been Updated Successfully!'
                );
            }
            else{
                $this->addFlash(
                    'success',
                    'RoadRoute Has been Added Successfully!'
                );
            }
            return $this->redirectToRoute('dashboard_route_configure',array('id'=>$route->getId()));
        }

        return $this->render('dashboard/routeConfigure.html.twig', array(
            'heading' => 'RoadRoute Configure',
            'errors' => $errors,
            'isEdit'=>$isEdit,
            'form' => $form->createView(),
        ));
    }


}