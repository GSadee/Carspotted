<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\ImageInterface;
use AppBundle\Entity\SpotInterface;
use AppBundle\Uploader\ImageUploaderInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class ImageUploadListener
{
    /**
     * @var ImageUploaderInterface
     */
    private $uploader;

    /**
     * @param ImageUploaderInterface $uploader
     */
    public function __construct(ImageUploaderInterface $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * @param GenericEvent $event
     */
    public function uploadImage(GenericEvent $event)
    {
        $subject = $event->getSubject();
        Assert::isInstanceOf($subject, ImageInterface::class);

        if ($subject->hasFile()) {
            $this->uploader->upload($subject);
        }
    }

    /**
     * @param GenericEvent $event
     */
    public function uploadSpotPhoto(GenericEvent $event)
    {
        $subject = $event->getSubject();
        Assert::isInstanceOf($subject, SpotInterface::class);

        $this->uploadSpotPhotos($subject);
    }

    /**
     * @param SpotInterface $spot
     */
    private function uploadSpotPhotos(SpotInterface $spot)
    {
        $photos = $spot->getPhotos();
        foreach ($photos as $photo) {
            if ($photo->hasFile()) {
                $this->uploader->upload($photo);
            }

            if (null === $photo->getPath()) {
                $photos->removeElement($photo);
            }
        }
    }
}
