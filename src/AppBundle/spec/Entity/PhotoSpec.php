<?php

namespace spec\AppBundle\Entity;

use AppBundle\Entity\Photo;
use AppBundle\Entity\PhotoInterface;
use AppBundle\Entity\SpotInterface;
use PhpSpec\ObjectBehavior;

/**
 * @mixin Photo
 *
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class PhotoSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Entity\Photo');
    }

    function it_implements_photo_interface()
    {
        $this->shouldImplement(PhotoInterface::class);
    }

    function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function it_has_no_file_by_default()
    {
        $this->hasFile()->shouldReturn(false);
        $this->getFile()->shouldReturn(null);
    }

    function its_file_is_mutable()
    {
        $file = new \SplFileInfo(__FILE__);
        $this->setFile($file);
        $this->getFile()->shouldReturn($file);
    }

    function it_has_no_path_by_default()
    {
        $this->hasPath()->shouldReturn(false);
        $this->getPath()->shouldReturn(null);
    }

    function its_path_is_mutable()
    {
        $this->setPath('test/image.jpg');
        $this->getPath()->shouldReturn('test/image.jpg');
    }

    function it_has_no_spot_by_default()
    {
        $this->getSpot()->shouldReturn(null);
    }

    function its_spot_is_mutable(SpotInterface $spot)
    {
        $this->setSpot($spot);
        $this->getSpot()->shouldReturn($spot);
    }
}
