<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Behat\Service\Accessor;

use Behat\Type\NotificationType;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
interface NotificationAccessorInterface
{
    /**
     * @return string
     */
    public function getMessage();

    /**
     * @return NotificationType
     */
    public function getType();
}
