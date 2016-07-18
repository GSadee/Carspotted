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
    public function getWelcome();
}
