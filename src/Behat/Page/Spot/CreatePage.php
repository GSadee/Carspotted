<?php

namespace Behat\Page\Spot;

use Behat\Mink\Element\NodeElement;
use Behat\Page\SymfonyPage;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class CreatePage extends SymfonyPage implements CreatePageInterface
{
    /**
     * {@inheritdoc}
     */
    public function getRouteName()
    {
        return 'app_spot_create';
    }

    /**
     * {@inheritdoc}
     */
    public function chooseMake($makeName)
    {
        $this->getElement('make')->selectOption($makeName);
    }

    /**
     * {@inheritdoc}
     */
    public function chooseModel($modelName)
    {
        $this->getElement('model')->selectOption($modelName);
    }

    /**
     * {@inheritdoc}
     */
    public function specifyLatitude($latitude)
    {
        $this->getElement('latitude')->setValue($latitude);
    }

    /**
     * {@inheritdoc}
     */
    public function specifyLongitude($longitude)
    {
        $this->getElement('longitude')->setValue($longitude);
    }

    /**
     * {@inheritdoc}
     */
    public function specifyCountry($country)
    {
        $this->getElement('country')->setValue($country);
    }

    /**
     * {@inheritdoc}
     */
    public function specifyCity($city)
    {
        $this->getElement('city')->setValue($city);
    }

    /**
     * {@inheritdoc}
     */
    public function create()
    {
        $this->getDocument()->pressButton('Create');
    }

    /**
     * {@inheritdoc}
     */
    public function attachPhoto($path)
    {
        $filesPath = $this->getParameter('files_path');

        $this->getDocument()->clickLink('Add');

        $photoForm = $this->getLastPhotoElement();
        $photoForm->attachFile($filesPath.'photos/'.$path);
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefinedElements()
    {
        return array_merge(parent::getDefinedElements(), [
            'city' => '#app_spot_city',
            'country' => '#app_spot_country',
            'latitude' => '#app_spot_lat',
            'longitude' => '#app_spot_lng',
            'make' => '#app_spot_make',
            'model' => '#app_spot_model',
            'photos' => '#app_spot_photos',
        ]);
    }

    /**
     * @return NodeElement
     */
    private function getLastPhotoElement()
    {
        $photos = $this->getElement('photos');
        $items = $photos->findAll('css', 'div[data-form-collection="item"]');
        $photoInput = end($items)->find('css', 'input');

        return $photoInput;
    }
}
