<?php

namespace Behat\Page\Account;

use Behat\Page\SymfonyPageInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface RegisterConfirmationPageInterface extends SymfonyPageInterface
{
    /**
     * @param string $text
     *
     * @return bool
     */
    public function hasText($text);
}
