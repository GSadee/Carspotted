<?php

namespace Behat\Context\Ui;

use Behat\Context\BaseContext;
use Behat\Page\HomePageInterface;
use Webmozart\Assert\Assert;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class HomeContext extends BaseContext
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
     * @Then I should be on the homepage
     */
    public function iShouldBeOnTheHomepage()
    {
        Assert::true(
            $this->homePage->isOpen(),
            'I should be on the homepage, but I am not.'
        );
    }

    /**
     * @Then I should see a text :text
     */
    public function iShouldSeeText($text)
    {
        Assert::contains(
            $this->homePage->getTitle(),
            $text,
            'The text: %2$s cannot be found on page.'
        );
    }
}
