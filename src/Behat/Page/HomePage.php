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
    public function getTitle()
    {
        return $this->getElement('title')->getHtml();
    }

    /**
     * {@inheritdoc}
     */
    public function hasLogoutButton()
    {
        return $this->hasElement('logout_button');
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefinedElements()
    {
        return array_merge(parent::getDefinedElements(), [
            'title' => 'h1#logo',
            'logout_button' => 'li#logout'
        ]);
    }
}
