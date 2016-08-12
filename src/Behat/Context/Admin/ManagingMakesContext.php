<?php

namespace Behat\Context\Admin;

use Behat\Context\BaseContext;
use Behat\Page\Admin\Crud\IndexPageInterface;
use Webmozart\Assert\Assert;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class ManagingMakesContext extends BaseContext
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
     * @When I want to browse makes
     */
    public function iWantToBrowseMakes()
    {
        $this->indexPage->open();
    }

    /**
     * @Then I should see :numberOfMakes makes in the list
     */
    public function iShouldSeeMakessInTheList($numberOfMakes)
    {
        $foundRows = $this->indexPage->countItems();

        Assert::eq(
            $numberOfMakes,
            $foundRows,
            '%s rows with makes should appear on page, %s rows has been found'
        );
    }

    /**
     * @Then I should see the make named :makeName in the list
     */
    public function iShouldSeeTheMakeInTheList($makeName)
    {
        Assert::true(
            $this->indexPage->isSingleResourceOnPage(['name' => $makeName]),
            sprintf('Make with name %s has not been found.', $makeName)
        );
    }
}
