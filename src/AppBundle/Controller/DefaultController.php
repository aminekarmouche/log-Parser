<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Entry;
use AppBundle\Utils\Parser;
use AppBundle\Utils\Loader;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */

    public function indexWelcome(Request $request)
    {
        return new Response('Hello There!! Please visit /parse & /load to load the file to the DB or parse it!');
    }

    /**
     * @Route("/load", name="load")
     */

    public function indexLoad()
    {
        //get a connection
        $connection = $this->getDoctrine()->getConnection();
        //instanciate a loader
        $loader = new Loader();
        
        return new Response($loader->load($connection));
    }

    /**
     * @Route("/parse", name="parse")
     */

    public function indexParse()
    {
        //get doctrine manager to persist data 
        $em = $this->getDoctrine()->getManager();
        $parser = new Parser();

        return new Response($parser->parse($em));
    }
}
