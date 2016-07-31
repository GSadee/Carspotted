<?php

namespace spec\AppBundle\Entity;

use AppBundle\Entity\Spotter;
use AppBundle\Entity\SpotterInterface;
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
}
