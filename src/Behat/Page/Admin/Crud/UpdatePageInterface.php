<?php

namespace Behat\Page\Admin\Crud;

use Behat\Mink\Exception\ElementNotFoundException;
use Behat\Page\SymfonyPageInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface UpdatePageInterface extends SymfonyPageInterface
{
    /**
     * @param array $parameters
     *
     * @return bool
     */
    public function hasResourceValues(array $parameters);

    public function saveChanges();

    /**
     * @param string $element
     *
     * @return string
     *
     * @throws ElementNotFoundException
     */
    public function getValidationMessage($element);
}
