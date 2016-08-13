<?php

namespace Behat\Context\Admin;

use Behat\Context\BaseContext;
use Behat\Page\Admin\Crud\IndexPageInterface;
use Behat\Page\Admin\Make\CreatePageInterface;
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
     * @var CreatePageInterface
     */
    private $createPage;

    /**
     * @param IndexPageInterface $indexPage
     * @param CreatePageInterface $createPage
     */
    public function __construct(IndexPageInterface $indexPage, CreatePageInterface $createPage)
    {
        $this->indexPage = $indexPage;
        $this->createPage = $createPage;
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
     * @Then the make :makeName should appear in the registry
     */
    public function iShouldSeeTheMakeInTheList($makeName)
    {
        $this->iWantToBrowseMakes();

        Assert::true(
            $this->indexPage->isSingleResourceOnPage(['name' => $makeName]),
            sprintf('Make with name %s has not been found.', $makeName)
        );
    }

    /**
     * @When I want to add a new make
     */
    public function iWantToAddANewMake()
    {
        $this->createPage->open();
    }

    /**
     * @When I specify the name as :name
     */
    public function iSpecifyTheNameAs($name)
    {
        $this->createPage->specifyName($name);
    }

    /**
     * @When I add it
     */
    public function iAddIt()
    {
        $this->createPage->create();
    }
}
