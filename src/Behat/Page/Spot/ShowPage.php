<?php

namespace Behat\Page\Spot;

use Behat\Page\SymfonyPage;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class ShowPage extends SymfonyPage implements ShowPageInterface
{
    /**
     * {@inheritdoc}
     */
    public function getRouteName()
    {
        return 'app_spot_show';
    }

    /**
     * {@inheritdoc}
     */
    public function getCarName()
    {
        return $this->getElement('title')->getText();
    }

    /**
     * {@inheritdoc}
     */
    public function getSpotterUsername()
    {
        $spotterText = $this->getElement('subtitle')->getText();
        $offset = strlen('spotted by') + 1;

        return substr($spotterText, $offset, strpos($spotterText, 'at') - $offset - 1);
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefinedElements()
    {
        return array_merge(parent::getDefinedElements(), [
            'title' => '#spot-title',
            'subtitle' => '#spot-subtitle',
        ]);
    }
}
