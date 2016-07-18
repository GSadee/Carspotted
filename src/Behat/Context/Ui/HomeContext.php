<?php

namespace Behat\Context\Ui;

use Behat\Behat\Context\Context;
use Behat\Page\HomePageInterface;
use Webmozart\Assert\Assert;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class HomeContext implements Context
{
    /**
     * @var HomePageInterface
     */
    private $homePage;

    /**
     * @param HomePageInterface $homePage
     */
    public function __construct(HomePageInterface $homePage)
    {
        $this->homePage = $homePage;
    }

    /**
     * @When I view the homepage
     */
    public function iViewHomepage()
    {
        $this->homePage->open();
    }

    /**
     * @Then I should see a text :text
     */
    public function iShouldSeeText($text)
    {
        Assert::contains(
            $this->homePage->getWelcome(),
            $text,
            'The text: %2$s cannot be found on page.'
        );
    }
}
