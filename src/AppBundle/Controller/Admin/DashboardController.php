<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Doctrine\ORM\SpotRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class DashboardController extends Controller
{
    /**
     * @param Request $request
     * 
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $spotRepository = $this->getSpotRepository();

        $spots = $spotRepository->findByCreatedAt();

        return $this->render(
            $request->attributes->get('template'),
            [
                'spots' => $spots,
            ]
        );
    }

    /**
     * @return SpotRepositoryInterface
     */
    private function getSpotRepository()
    {
        return $this->container->get('app.repository.spot');
    }
}
