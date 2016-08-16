<?php

namespace AppBundle\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface PhotoInterface extends ResourceInterface, ImageInterface
{
    /**
     * @return SpotInterface
     */
    public function getSpot();

    /**
     * @param SpotInterface|null $spot
     */
    public function setSpot(SpotInterface $spot = null);
}
