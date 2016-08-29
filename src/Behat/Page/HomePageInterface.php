<?php

namespace Behat\Page;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface HomePageInterface extends SymfonyPageInterface
{
    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return bool
     */
    public function hasLogoutButton();

    /**
     * @return int
     */
    public function countSpots();
}
