<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // on récupère toutes les news
        $em = $this->getDoctrine()->getManager();

        $news = $em->getRepository('AppBundle:News')->findAll();

        // on appel la vue et on y affiche les news
        return $this->render('default/index.html.twig', [
           "thenews"=>$news
        ]);
    }
}
