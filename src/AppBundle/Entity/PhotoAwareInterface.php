<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface PhotoAwareInterface
{
    /**
     * @return Collection|PhotoInterface[]
     */
    public function getPhotos();

    /**
     * @param Collection $photos
     */
    public function setPhotos(Collection $photos);

    /**
     * @return  PhotoInterface
     */
    public function getPhoto();

    /**
     * @param PhotoInterface $photo
     */
    public function addPhoto(PhotoInterface $photo);

    /**
     * @param PhotoInterface $photo
     */
    public function removePhoto(PhotoInterface $photo);

    /**
     * @param PhotoInterface $photo
     *
     * @return bool
     */
    public function hasPhoto(PhotoInterface $photo);
}
