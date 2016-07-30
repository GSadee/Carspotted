<?php

namespace spec\AppBundle\Entity;

use AppBundle\Entity\MakeInterface;
use AppBundle\Entity\Model;
use AppBundle\Entity\ModelInterface;
use PhpSpec\ObjectBehavior;

/**
 * @mixin Model
 *
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class ModelSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Entity\Model');
    }

    function it_implements_model_interface()
    {
        $this->shouldImplement(ModelInterface::class);
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
        $this->setName('Insignia');
        $this->getName()->shouldReturn('Insignia');
    }

    function it_has_no_make_by_default()
    {
        $this->getMake()->shouldReturn(null);
    }

    function its_make_is_mutable(MakeInterface $make)
    {
        $this->setMake($make);
        $this->getMake()->shouldReturn($make);
    }
}
