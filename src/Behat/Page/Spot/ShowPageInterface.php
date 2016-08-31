<?php

namespace Behat\Page\Spot;

use Behat\Page\SymfonyPageInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface ShowPageInterface extends SymfonyPageInterface
{
    /**
     * @return string
     */
    public function getCarName();

    /**
     * @return string
     */
    public function getSpotterUsername();
}
