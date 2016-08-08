<?php

namespace Behat\Context;

use Behat\Behat\Context\Context;
use Behat\Page\SymfonyPageInterface;
use Webmozart\Assert\Assert;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class BaseContext implements Context
{
    /**
     * @param SymfonyPageInterface $page
     * @param string $element
     * @param string $expectedMessage
     */
    protected function assertFieldValidationMessage(SymfonyPageInterface $page, $element, $expectedMessage)
    {
        Assert::true(
            $page->checkValidationMessageFor($element, $expectedMessage),
            sprintf('There is no validation message: "%s" for element: %s', $expectedMessage, $element)
        );
    }
}
