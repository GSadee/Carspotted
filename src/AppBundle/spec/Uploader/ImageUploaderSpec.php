<?php

namespace spec\AppBundle\Uploader;

use AppBundle\Entity\ImageInterface;
use AppBundle\Uploader\ImageUploader;
use AppBundle\Uploader\ImageUploaderInterface;
use Gaufrette\Filesystem;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @mixin ImageUploader
 *
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class ImageUploaderSpec extends ObjectBehavior
{
    function let(Filesystem $filesystem, ImageInterface $image)
    {
        $filesystem->has(Argument::any())->willReturn(false);

        $file = new File(__FILE__, 'img.jpg');
        $image->getFile()->willReturn($file);

        $this->beConstructedWith($filesystem);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Uploader\ImageUploader');
    }

    function it_implements_image_uploader_interface()
    {
        $this->shouldImplement(ImageUploaderInterface::class);
    }

    function it_uploads_an_image($filesystem, $image)
    {
        $image->hasFile()->willReturn(true);
        $image->getPath()->willReturn('img.jpg');

        $filesystem->delete(Argument::any())->shouldBeCalled();
        $filesystem->write(Argument::any(), Argument::any())->shouldBeCalled();

        $image->setPath(Argument::any())->shouldBeCalled();

        $this->upload($image);
    }
}
