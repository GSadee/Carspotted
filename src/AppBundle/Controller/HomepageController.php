<?php

namespace AppBundle\Controller;

use AppBundle\Doctrine\ORM\SpotRepositoryInterface;
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
        $spotRepository = $this->getSpotRepository();
        $spots = $spotRepository->findLatest();

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
        return $this->get('app.repository.spot');
    }
}
