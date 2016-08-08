<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Behat\Page;

use Behat\Mink\Exception\ElementNotFoundException;

/**
 * @author Łukasz Chruściel <lukasz.chrusciel@lakion.com>
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface SymfonyPageInterface extends PageInterface
{
    /**
     * @return string
     */
    public function getRouteName();

    /**
     * @param string $element
     * @param string $message
     *
     * @return bool
     *
     * @throws ElementNotFoundException
     */
    public function checkValidationMessageFor($element, $message);
}
