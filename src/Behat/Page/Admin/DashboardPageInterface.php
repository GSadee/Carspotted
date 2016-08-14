<?php

namespace Behat\Page\Admin;

use Behat\Page\SymfonyPageInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface DashboardPageInterface extends SymfonyPageInterface
{
    /**
     * @return string
     */
    public function getHeader();

    /**
     * @return int
     */
    public function countSpots();
}
