<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface SpotAwareInterface
{
    /**
     * @return Collection|SpotInterface[]
     */
    public function getSpots();

    /**
     * @param Collection $spots
     */
    public function setSpots(Collection $spots);

    /**
     * @param SpotInterface $spot
     */
    public function addSpot(SpotInterface $spot);

    /**
     * @param SpotInterface $spot
     */
    public function removeSpot(SpotInterface $spot);

    /**
     * @param SpotInterface $spot
     *
     * @return bool
     */
    public function hasSpot(SpotInterface $spot);
}
