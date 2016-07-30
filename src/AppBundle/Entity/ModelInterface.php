<?php

namespace AppBundle\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface ModelInterface extends ResourceInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return MakeInterface
     */
    public function getMake();

    /**
     * @param MakeInterface $make
     */
    public function setMake($make);
}
