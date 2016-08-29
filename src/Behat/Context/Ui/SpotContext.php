<?php

namespace Behat\Context\Ui;

use Behat\Context\BaseContext;
use Behat\Page\Spot\IndexPageInterface;
use Webmozart\Assert\Assert;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class SpotContext extends BaseContext
{
    /**
     * @var IndexPageInterface
     */
    private $indexPage;

    /**
     * @param IndexPageInterface $indexPage
     */
    public function __construct(IndexPageInterface $indexPage)
    {
        $this->indexPage = $indexPage;
    }

    /**
     * @When I want to browse spots
     */
    public function iWantToBrowseSpots()
    {
        $this->indexPage->open();
    }

    /**
     * @Then I should see :numberOfSpots spots in the list
     */
    public function iShouldSeeSpotsInTheList($numberOfSpots)
    {
        $foundRows = $this->indexPage->countItems();

        Assert::eq(
            $numberOfSpots,
            $foundRows,
            '%s rows with spots should appear on page, %s rows has been found'
        );
    }

    /**
     * @Then /^I should see "([^"]*)" spotted by "([^"]*)" in the list$/
     */
    public function iShouldSeeSpottedByInTheList($car, $spotterUsername)
    {
        Assert::true(
            $this->indexPage->isSingleResourceOnPage(['car' => $car, 'spotter' => $spotterUsername]),
            sprintf('Spot of car %s spotted by $s has not been found.', $car, $spotterUsername)
        );
    }
}
