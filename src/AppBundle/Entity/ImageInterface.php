<?php

namespace AppBundle\Entity;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface ImageInterface
{
    /**
     * @return bool
     */
    public function hasFile();

    /**
     * @return null|\SplFileInfo
     */
    public function getFile();

    /**
     * @param \SplFileInfo $file
     */
    public function setFile(\SplFileInfo $file);

    /**
     * @return string
     */
    public function getPath();

    /**
     * @param string $path
     */
    public function setPath($path);
}
