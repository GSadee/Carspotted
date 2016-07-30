<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface ModelAwareInterface
{
    /**
     * @return Collection|ModelInterface[]
     */
    public function getModels();

    /**
     * @param Collection $models
     */
    public function setModels(Collection $models);

    /**
     * @param ModelInterface $model
     */
    public function addModel(ModelInterface $model);

    /**
     * @param ModelInterface $model
     */
    public function removeModel(ModelInterface $model);

    /**
     * @param ModelInterface $model
     *
     * @return bool
     */
    public function hasModel(ModelInterface $model);
}
