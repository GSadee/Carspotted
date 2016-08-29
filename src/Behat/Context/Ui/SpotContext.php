<?php

namespace Behat\Context\Ui;

use Behat\Context\BaseContext;
use Behat\Page\Spot\IndexBySpotterPageInterface;
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
     * @var IndexBySpotterPageInterface
     */
    private $indexBySpotterPage;

    /**
     * @param IndexPageInterface $indexPage
     * @param IndexBySpotterPageInterface $indexBySpotterPage
     */
    public function __construct(IndexPageInterface $indexPage, IndexBySpotterPageInterface $indexBySpotterPage)
    {
        $this->indexPage = $indexPage;
        $this->indexBySpotterPage = $indexBySpotterPage;
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
     * @Then I should see :car spotted by :spotterUsername in the list
     */
    public function iShouldSeeSpottedByInTheList($car, $spotterUsername)
    {
        Assert::true(
            $this->indexPage->isSingleResourceOnPage(['car' => $car, 'spotter' => $spotterUsername]),
            sprintf('Spot of car %s spotted by $s has not been found.', $car, $spotterUsername)
        );
    }

    /**
     * @When I want to browse my spots
     */
    public function iWantToBrowseMySpots()
    {
        $this->indexBySpotterPage->open();
    }

    /**
     * @Then I should see a single spot in the list
     */
    public function iShouldSeeASingleSpotInTheList()
    {
        $foundRows = $this->indexBySpotterPage->countItems();

        Assert::eq(
            1,
            $foundRows,
            '%s rows with spots should appear on page, %s rows has been found'
        );
    }

    /**
     * @Then I should see :car in the list
     */
    public function iShouldSeeCarInTheList($car)
    {
        Assert::true(
            $this->indexBySpotterPage->isSingleResourceOnPage(['car' => $car]),
            sprintf('Spot of car %s has not been found.', $car)
        );
    }

    /**
     * @Then I should not see :car in the list
     */
    public function iShouldNotSeeInTheList($car)
    {
        Assert::false(
            $this->indexBySpotterPage->isSingleResourceOnPage(['car' => $car]),
            sprintf('Spot of car %s has been found.', $car)
        );
    }
}
