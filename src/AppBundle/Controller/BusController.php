<?php
/**
 * Created by PhpStorm.
 * User: uwin5
 * Date: 05/20/18
 * Time: 7:25 PM
 */

namespace AppBundle\Controller;



use AppBundle\Entity\Bus;
use AppBundle\Entity\User;
use AppBundle\Form\BusType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Acl\Exception\Exception;

class BusController extends BaseController
{

    /**
     * @Route("/dashboard/bus/configure/{id}", name="dashboard_bus_configure")
     */
    public function busConfigureAction(Request $request,$id=null)
    {
        $isEdit=null;
        if($id==null){
            $bus=new Bus();
            $bus_user = new User();
            $driver_role = $this->getRepository('Role')->findOneBy(array('metacode'=>'ROLE_DRIVER'));
            $bus_user->setRole($driver_role);
            $bus->setUser($bus_user);
            $isEdit=false;
        }
        else{
            $bus = $this->getRepository('Bus')->find($id);
            $bus_user=$bus->getUser();
            $isEdit=true;
        }
        if($bus==null){
            return null;
        }
        $form = $this->createForm(BusType::class, $bus);
        $form->handleRequest($request);
        $errors = $form->getErrors();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();

            if(!$isEdit){
                $bus_user->setUsername($bus->getBusNo().trim(" "));
                $bus_user->setName($bus->getBusNo());
                $bus_user->setIsActive(true);
                $encoder = $this->container->get('security.password_encoder');
                $encoded = $encoder->encodePassword($bus_user, "driver@bus");
                $bus_user->setPassword($encoded);
                try{
                    $em->persist($bus_user);
                    $em->flush();
                }
                catch(Exception $e){
                    $this->addFlash(
                        'error',
                        'Bus Plate No already exists !!!'
                    );
                    return $this->redirectToRoute('dashboard_bus_configure');
                }

                try{
                    $res = $this->get('api.node_api')->newVirtualDevice($bus_user->getUsername());

                    if ($res->response == 'new virtual device created') {
                        $result = '1';

                    }
                }
                catch (\Exception $e){
                    $result = '0';
                }

            }

            $em->persist($bus);
            $em->flush();
            if($isEdit){
                $this->addFlash(
                    'success',
                    'Bus Has been Updated Successfully!'
                );
            }
            else{
                $this->addFlash(
                    'success',
                    'Bus Has been Added Successfully!'
                );
            }
            return $this->redirectToRoute('dashboard_bus_configure',array('id'=>$bus->getId()));
        }

        return $this->render('dashboard/busConfigure.html.twig', array(
            'heading' => 'Bus Configure',
            'errors' => $errors,
            'isEdit'=>$isEdit,
            'form' => $form->createView(),
            'bus_user'=>$bus_user
        ));
    }

    /**
     * @Route("/dashboard/bus/list", name="dashboard_view_bus_list")
     */
    public function viewBusListAction(Request $request)
    {

        $routes=$this->getRepository('RoadRoute')->findBy(array('published'=>true));

        $buses = $this->getRepository('Bus')->findBy(array('route'=>$routes[0]));


        return $this->render('dashboard/busList.html.twig', array(
            'buses' => $buses,
            'routes'=>$routes,
            'heading' => 'Bus List',
        ));
    }



    /**
     * @Route("/dashboard/bus/list/ajax/load/data", name="dashboard_bus_list_ajax_load_data")
     */
    public function busLoadAjaxAction(Request $request)
    {
        $data=json_decode($request->get('data'));
        $route=$this->getRepository('RoadRoute')->find($data->route);
        $buses=$this->getRepository('Bus')->findBy(array('route'=>$route));
        $stdBuses=array();
        for($i=0;$i<count($buses);$i++){
            $stdBus=new \stdClass();
            $stdBus->id=$buses[$i]->getId();
            if($buses[$i]->getBusName() !=null){
                $stdBus->busName=$buses[$i]->getBusName();
            }
            else{
                $stdBus->busName="-";
            }

            $stdBus->busNo=$buses[$i]->getBusNo();
            $stdBus->connected=$buses[$i]->getUser()->getIsConnected();
            array_push($stdBuses,$stdBus);


        }

        return new Response(json_encode($stdBuses),200);
    }




}