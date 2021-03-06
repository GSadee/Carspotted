<?php

namespace AppBundle\Doctrine\ORM;

use AppBundle\Entity\MakeInterface;
use AppBundle\Entity\ModelInterface;
use AppBundle\Entity\SpotterInterface;
use Pagerfanta\Pagerfanta;
use Sylius\Component\Resource\Repository\RepositoryInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface SpotRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $limit
     *
     * @return array
     */
    public function findByCreatedAt($limit = 10);

    /**
     * @return Pagerfanta
     */
    public function createEnabledPaginator();

    /**
     * @return Pagerfanta
     */
    public function createEnabledBySpotterPaginator(SpotterInterface $spotter);

    /**
     * @param int $limit
     *
     * @return array
     */
    public function findLatest($limit = 4);

    /**
     * @param MakeInterface $make
     * @param ModelInterface $model
     */
    public function findOneByMakeAndModel(MakeInterface $make, ModelInterface $model);
}
