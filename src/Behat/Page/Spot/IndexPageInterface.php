<?php

namespace Behat\Page\Spot;

use Behat\Page\SymfonyPageInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface IndexPageInterface extends SymfonyPageInterface
{
    /**
     * @param array $parameters
     *
     * @return bool
     */
    public function isSingleResourceOnPage(array $parameters);

    /**
     * @return int
     */
    public function countItems();
}
