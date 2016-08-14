<?php

namespace AppBundle\Doctrine\ORM;

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
}
