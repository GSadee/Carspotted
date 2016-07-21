<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class HomepageController extends Controller
{
    /**
     * @param Request $request
     * 
     * @return Response
     */
    public function indexAction(Request $request)
    {
        return $this->render(
            ':Homepage:index.html.twig',
            [
                'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            ]
        );
    }
}
