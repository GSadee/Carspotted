<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class Spotter extends User implements SpotterInterface
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var Collection|SpotterInterface[]
     */
    private $spots;

    public function __construct()
    {
        parent::__construct();

        $this->salt = null;
        $this->spots = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getSpots()
    {
        return $this->spots;
    }

    /**
     * {@inheritdoc}
     */
    public function setSpots(Collection $spots)
    {
        $this->spots = $spots;
    }

    /**
     * {@inheritdoc}
     */
    public function addSpot(SpotInterface $spot)
    {
        if (!$this->hasSpot($spot)) {
            $this->spots->add($spot);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeSpot(SpotInterface $spot)
    {
        if ($this->hasSpot($spot)) {
            $this->spots->removeElement($spot);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasSpot(SpotInterface $spot)
    {
        return $this->spots->contains($spot);
    }
}
