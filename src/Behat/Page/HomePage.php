<?php

namespace Behat\Page;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class HomePage extends SymfonyPage implements HomePageInterface
{
    /**
     * {@inheritdoc}
     */
    public function getRouteName()
    {
        return 'app_homepage';
    }

    /**
     * {@inheritdoc}
     */
    public function getWelcome()
    {
        return $this->getElement('welcome')->getHtml();
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefinedElements()
    {
        return array_merge(parent::getDefinedElements(), [
            'welcome' => 'div#welcome'
        ]);
    }
}
