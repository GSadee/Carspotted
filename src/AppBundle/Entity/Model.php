<?php

namespace AppBundle\Entity;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class Model implements ModelInterface
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
     * @var MakeInterface
     */
    private $make;

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
     * @return MakeInterface
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * @param MakeInterface $make
     */
    public function setMake($make)
    {
        $this->make = $make;
    }
}
