<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class WelcomeController extends Controller
{
    /**
     * @Route("/", name="_welcome")
     * @Template()
     */
    public function indexAction()
    {
        /*
         * The action's view can be rendered using render() method
         * or @Template annotation as demonstrated in DemoController.
         *
         */
        return $this->render('AcmeDemoBundle:Welcome:index.html.twig');
    }

    /**
     * @Route("/bonus-1", name="_bonus_1")
     * @Template()
     */
    public function bonus1Action()
    {
        return array();
    }

    /**
     * @Route("/bonus-2", name="_bonus_2")
     * @Template()
     */
    public function bonus2Action()
    {
        return array();
    }
}
