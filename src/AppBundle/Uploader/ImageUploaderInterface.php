<?php

namespace AppBundle\Uploader;

use AppBundle\Entity\ImageInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface ImageUploaderInterface
{
    /**
     * @param ImageInterface $image
     */
    public function upload(ImageInterface $image);

    /**
     * @param string $path
     */
    public function remove($path);
}
