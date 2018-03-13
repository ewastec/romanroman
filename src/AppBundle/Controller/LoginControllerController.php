<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class LoginControllerController extends Controller
{
    

    /**
     * @Route("/register")
     */
    public function registerAction()
    {
        return $this->render('default/register.html.twig', array(
            // ...
        ));
    }

}
