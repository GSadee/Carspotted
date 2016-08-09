<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\GroupableInterface;
use FOS\UserBundle\Model\UserInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface SpotterInterface extends ResourceInterface, UserInterface, GroupableInterface
{
}
