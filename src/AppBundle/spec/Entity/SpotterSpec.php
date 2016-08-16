<?php

namespace spec\AppBundle\Entity;

use AppBundle\Entity\SpotInterface;
use AppBundle\Entity\Spotter;
use AppBundle\Entity\SpotterInterface;
use Doctrine\Common\Collections\Collection;
use PhpSpec\ObjectBehavior;

/**
 * @mixin Spotter
 *
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class SpotterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Entity\Spotter');
    }

    function it_implements_spotter_interface()
    {
        $this->shouldImplement(SpotterInterface::class);
    }

    function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function it_initializes_spot_collection_by_default()
    {
        $this->getSpots()->shouldHaveType(Collection::class);
    }

    function its_spots_are_mutable(Collection $spots)
    {
        $this->setSpots($spots);
        $this->getSpots()->shouldReturn($spots);
    }

    function it_adds_spot(SpotInterface $spot)
    {
        $this->addSpot($spot);

        $this->hasSpot($spot)->shouldReturn(true);
    }

    function it_removes_spot(SpotInterface $spot)
    {
        $this->addSpot($spot);
        $this->removeSpot($spot);

        $this->hasSpot($spot)->shouldReturn(false);
    }
}
