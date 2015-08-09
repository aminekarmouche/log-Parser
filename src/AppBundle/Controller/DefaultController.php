<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Page;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/product", name="product")
     */   

    public function createAction()
    {
        $page = new Page();
        $page->setName('A Foo Bar');
        $page->setNumber(241);

        $str= new \DateTime('12569537329');
        $page->setTimest($str);
        
        $em = $this->getDoctrine()->getManager();

        $em->persist($page);
        $em->flush();

        return new Response('Created product id '.$page->getId());
    }

}
