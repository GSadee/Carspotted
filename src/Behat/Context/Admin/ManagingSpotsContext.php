<?php

namespace Behat\Context\Admin;

use AppBundle\Entity\SpotInterface;
use Behat\Context\BaseContext;
use Behat\Page\Admin\Crud\IndexPageInterface;
use Behat\Page\Admin\Spot\UpdatePageInterface;
use Webmozart\Assert\Assert;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class ManagingSpotsContext extends BaseContext
{
    /**
     * @var IndexPageInterface
     */
    private $indexPage;

    /**
     * @var UpdatePageInterface
     */
    private $updatePage;

    /**
     * @param IndexPageInterface $indexPage
     * @param UpdatePageInterface $updatePage
     */
    public function __construct(IndexPageInterface $indexPage, UpdatePageInterface $updatePage)
    {
        $this->indexPage = $indexPage;
        $this->updatePage = $updatePage;
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
     * @When /^I want to modify (this spot)$/
     */
    public function iWantToModifyThisSpot(SpotInterface $spot)
    {
        $this->updatePage->open(['id' => $spot->getId()]);
    }

    /**
     * @When I change a model to :modelName
     */
    public function iChangeAModelTo($modelName)
    {
        $this->updatePage->chooseModel($modelName);
    }

    /**
     * @When I enable it
     */
    public function iEnableIt()
    {
        $this->updatePage->enable();
    }

    /**
     * @When I save my changes
     * @When I try to save my changes
     */
    public function iSaveMyChanges()
    {
        $this->updatePage->saveChanges();
    }

    /**
     * @When /^I delete (this spot)$/
     */
    public function iDeleteTheSpot(SpotInterface $spot)
    {
        $this->indexPage->open();
        $this->indexPage->deleteResourceOnPage(['id' => $spot->getId()]);
    }

    /**
     * @Then /^(this spot) ([^"]+) should be "([^"]+)"$/
     */
    public function thisSpotElementShouldBe(SpotInterface $spot, $element, $value)
    {
        $this->iWantToBrowseSpots();

        Assert::true(
            $this->indexPage->isSingleResourceOnPage([
                'id' => $spot->getId(),
                $element => $value,
            ]),
            sprintf('Spot %s should be %s', $element, $value)
        );
    }

    /**
     * @Then /^(this spot) should be enabled$/
     */
    public function thisSpotShouldBeEnabled(SpotInterface $spot)
    {
        $this->iWantToBrowseSpots();

        Assert::true(
            $this->indexPage->isSingleResourceOnPage([
                'id' => $spot->getId(),
                'enabled' => 'enabled',
            ]),
            'Spot should be enabled'
        );
    }
}
