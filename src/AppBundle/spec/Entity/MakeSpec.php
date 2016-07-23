<?php

namespace spec\AppBundle\Entity;

use AppBundle\Entity\MakeInterface;
use PhpSpec\ObjectBehavior;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class MakeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Entity\Make');
    }

    function it_implements_make_interface()
    {
        $this->shouldImplement(MakeInterface::class);
    }

    function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function it_has_no_name_by_default()
    {
        $this->getName()->shouldReturn(null);
    }

    function its_name_is_mutable()
    {
        $this->setName('Opel');
        $this->getName()->shouldReturn('Opel');
    }
}
