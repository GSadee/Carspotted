<?php

namespace Behat\Page\Spot;

use Behat\Page\SymfonyPageInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface CreatePageInterface extends SymfonyPageInterface
{
    /**
     * @param string $makeName
     */
    public function chooseMake($makeName);

    /**
     * @param string $modelName
     */
    public function chooseModel($modelName);

    /**
     * @param string $latitude
     */
    public function specifyLatitude($latitude);

    /**
     * @param string $longitude
     */
    public function specifyLongitude($longitude);

    /**
     * @param string $country
     */
    public function specifyCountry($country);

    /**
     * @param string $city
     */
    public function specifyCity($city);

    public function create();

    /**
     * @param string $path
     */
    public function attachPhoto($path);
}
