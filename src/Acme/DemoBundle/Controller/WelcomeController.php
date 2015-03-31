<?php

namespace Acme\DemoBundle\Controller;

use Acme\DemoBundle\Entity\User;
use Acme\DemoBundle\Form\SubscriptionType;
use Acme\DemoBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;

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
        $entity = new User();
        $form = $this->get('form.factory')->create(new SubscriptionType(), $entity);

        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $em = $this->get('doctrine.orm.entity_manager');
                $em->persist($entity);
                $em->flush();

//                $this->get('session')->getFlashBag()->set('notice', 'Message sent!');

                return new RedirectResponse($this->generateUrl('_list_bonus'));
            }
        }

        return array(
            'form' => $form->createView(),
            'errors' => $form->getErrors()
        );
    }

    /**
     * @Route("/list", name="_list_bonus")
     * @Template()
     * @return array
     */
    public function listbonusAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeDemoBundle:User')->findAll();

        return array(
            'entities' => $entities
        );
    }

    /**
     * @Route("/bonus-2", name="_bonus_2")
     * @Template()
     */
    public function bonus2Action()
    {
        $entity = new User();
        $form = $this->get('form.factory')->create(new UserType(), $entity);

        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $em = $this->get('doctrine.orm.entity_manager');
                $em->persist($entity);
                $em->flush();

                $this->get('session')->getFlashBag()->set('notice', 'Message sent!');

                return new RedirectResponse($this->generateUrl('_list_bonus'));
            }
        }

        return array(
            'form' => $form->createView(),
            'errors' => $form->getErrors()
        );
    }
}
