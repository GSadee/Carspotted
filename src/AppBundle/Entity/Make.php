<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class Make implements MakeInterface
{
    /**
     * @var mixed
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Collection|ModelInterface[]
     */
    private $models;

    /**
     * @var \SplFileInfo
     */
    private $file;

    /**
     * @var string
     */
    private $path;

    public function __construct()
    {
        $this->models = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getModels()
    {
        return $this->models;
    }

    /**
     * {@inheritdoc}
     */
    public function setModels(Collection $models)
    {
        $this->models = $models;
    }

    /**
     * {@inheritdoc}
     */
    public function addModel(ModelInterface $model)
    {
        if (!$this->hasModel($model)) {
            $this->models->add($model);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeModel(ModelInterface $model)
    {
        if ($this->hasModel($model)) {
            $this->models->removeElement($model);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasModel(ModelInterface $model)
    {
        return $this->models->contains($model);
    }

    /**
     * {@inheritdoc}
     */
    public function hasFile()
    {
        return null !== $this->file;
    }

    /**
     * {@inheritdoc}
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * {@inheritdoc}
     */
    public function setFile(\SplFileInfo $file)
    {
        $this->file = $file;
    }

    /**
     * {@inheritdoc}
     */
    public function hasPath()
    {
        return null !== $this->path;
    }

    /**
     * {@inheritdoc}
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * {@inheritdoc}
     */
    public function setPath($path)
    {
        $this->path = $path;
    }
}
