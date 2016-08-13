<?php

namespace AppBundle\Entity;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class Spot implements SpotInterface
{
    /**
     * @var mixed
     */
    private $id;

    /**
     * @var string
     */
    private $description;

    /**
     * @var MakeInterface
     */
    private $make;

    /**
     * @var ModelInterface
     */
    private $model;

    /**
     * @var SpotterInterface
     */
    private $spotter;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var double
     */
    private $lat;

    /**
     * @var double
     */
    private $lng;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $city;

    /**
     * @var bool
     */
    private $illegiblePlate = false;

    /**
     * @var string
     */
    private $licensePlate;

    /**
     * @var bool
     */
    private $enabled = false;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * {@inheritdoc}
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * {@inheritdoc}
     */
    public function setMake($make)
    {
        $this->make = $make;
    }

    /**
     * {@inheritdoc}
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * {@inheritdoc}
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * {@inheritdoc}
     */
    public function getSpotter()
    {
        return $this->spotter;
    }

    /**
     * {@inheritdoc}
     */
    public function setSpotter($spotter)
    {
        $this->spotter = $spotter;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * {@inheritdoc}
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * {@inheritdoc}
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * {@inheritdoc}
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
    }

    /**
     * {@inheritdoc}
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * {@inheritdoc}
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * {@inheritdoc}
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * {@inheritdoc}
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * {@inheritdoc}
     */
    public function isIllegiblePlate()
    {
        return $this->illegiblePlate;
    }

    /**
     * {@inheritdoc}
     */
    public function setIllegiblePlate($illegiblePlate)
    {
        $this->illegiblePlate = $illegiblePlate;
    }

    /**
     * {@inheritdoc}
     */
    public function getLicencePlate()
    {
        return $this->licensePlate;
    }

    /**
     * {@inheritdoc}
     */
    public function setLicencePlate($licencePlate)
    {
        $this->licensePlate = $licencePlate;
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }
}
