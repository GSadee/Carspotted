<?php

namespace spec\AppBundle\EventListener;

use AppBundle\Entity\ImageInterface;
use AppBundle\EventListener\ImageUploadListener;
use AppBundle\Uploader\ImageUploaderInterface;
use PhpSpec\ObjectBehavior;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * @mixin ImageUploadListener
 *
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class ImageUploadListenerSpec extends ObjectBehavior
{
    function let(ImageUploaderInterface $uploader)
    {
        $this->beConstructedWith($uploader);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\EventListener\ImageUploadListener');
    }

    function it_uses_image_uploader_to_upload_an_image(
        GenericEvent $event,
        ImageInterface $image,
        ImageUploaderInterface $uploader
    ) {
        $event->getSubject()->willReturn($image);
        $uploader->upload($image)->shouldBeCalled();
        $image->hasFile()->willReturn(true);

        $this->uploadImage($event);
    }

    function it_throws_exception_if_event_subject_is_not_an_image(
        GenericEvent $event,
        \stdClass $object
    ) {
        $event->getSubject()->willReturn($object);

        $this
            ->shouldThrow(\InvalidArgumentException::class)
            ->duringUploadImage($event)
        ;
    }
}
