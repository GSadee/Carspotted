<?php

namespace AppBundle\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface SpotInterface extends ResourceInterface
{
    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     */
    public function setDescription($description);

    /**
     * @return MakeInterface
     */
    public function getMake();

    /**
     * @param MakeInterface $make
     */
    public function setMake($make);

    /**
     * @return ModelInterface
     */
    public function getModel();

    /**
     * @param ModelInterface $model
     */
    public function setModel($model);

    /**
     * @return SpotterInterface
     */
    public function getSpotter();

    /**
     * @param SpotterInterface $spotter
     */
    public function setSpotter($spotter);

    /**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt);

    /**
     * @return double
     */
    public function getLat();

    /**
     * @param double $lat
     */
    public function setLat($lat);

    /**
     * @return double
     */
    public function getLng();

    /**
     * @param double $lng
     */
    public function setLng($lng);

    /**
     * @return string
     */
    public function getCountry();

    /**
     * @param string $country
     */
    public function setCountry($country);

    /**
     * @return string
     */
    public function getCity();

    /**
     * @param string $city
     */
    public function setCity($city);

    /**
     * @return bool
     */
    public function isIllegiblePlate();

    /**
     * @param bool $illegiblePlate
     */
    public function setIllegiblePlate($illegiblePlate);

    /**
     * @return string
     */
    public function getLicensePlate();

    /**
     * @param string $licensePlate
     */
    public function setLicensePlate($licensePlate);

    /**
     * @return bool
     */
    public function isEnabled();

    /**
     * @param bool $enabled
     */
    public function setEnabled($enabled);
}
