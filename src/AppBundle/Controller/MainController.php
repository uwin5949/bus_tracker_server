<?php
/**
 * Created by PhpStorm.
 * User: uwin5
 * Date: 05/20/18
 * Time: 2:53 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class MainController extends BaseController
{

    /**
     * @Route("/dashboard", name="dashboard_home")
     */
    public function indexAction(Request $request)
    {
        $this->addFlash('info', 'Welcome Back!');
        return $this->render('dashboard/home.html.twig', array(
            'heading' => 'Dashboard',
        ));
    }

}