<?php

namespace Behat\Context\Admin;

use AppBundle\Entity\MakeInterface;
use Behat\Context\BaseContext;
use Behat\Page\Admin\Crud\IndexPageInterface;
use Behat\Page\Admin\Make\CreatePageInterface;
use Behat\Page\Admin\Make\UpdatePageInterface;
use Behat\Service\Resolver\CurrentPageResolverInterface;
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
     * @var UpdatePageInterface
     */
    private $updatePage;

    /**
     * @var CurrentPageResolverInterface
     */
    private $currentPageResolver;

    /**
     * @param IndexPageInterface $indexPage
     * @param CreatePageInterface $createPage
     * @param UpdatePageInterface $updatePage
     * @param CurrentPageResolverInterface $currentPageResolver
     */
    public function __construct(
        IndexPageInterface $indexPage,
        CreatePageInterface $createPage,
        UpdatePageInterface $updatePage,
        CurrentPageResolverInterface $currentPageResolver
    ) {
        $this->indexPage = $indexPage;
        $this->createPage = $createPage;
        $this->updatePage = $updatePage;
        $this->currentPageResolver = $currentPageResolver;
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
     * @Then the make :makeName should no longer exist in the registry
     */
    public function theMakeShouldNoLongerExistInTheRegistry($makeName)
    {
        Assert::false(
            $this->indexPage->isSingleResourceOnPage(['name' => $makeName]),
            sprintf('Make with name %s exists but should not.', $makeName)
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
     * @When I do not specify the name
     */
    public function iSpecifyTheNameAs($name = null)
    {
        $this->createPage->specifyName($name);
    }

    /**
     * @When I rename it to :name
     * @When I remove its name
     */
    public function iRenameItTo($name = null)
    {
        $this->updatePage->specifyName($name);
    }

    /**
     * @When I add it
     * @When I try to add it
     */
    public function iAddIt()
    {
        $this->createPage->create();
    }

    /**
     * @When I want to modify the make :make
     * @When /^I want to modify (this make)$/
     */
    public function iWantToModifyMake(MakeInterface $make)
    {
        $this->updatePage->open(['id' => $make->getId()]);
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
     * @Then this make :element should be :value
     */
    public function thisMakeElementShouldBe($element, $value)
    {
        Assert::true(
            $this->updatePage->hasResourceValues([$element => $value]),
            sprintf('Make %s should be %s', $element, $value)
        );
    }

    /**
     * @When I delete the make :make
     */
    public function iDeleteTheMake(MakeInterface $make)
    {
        $this->indexPage->open();
        $this->indexPage->deleteResourceOnPage(['name' => $make->getName()]);
    }

    /**
     * @Then I should be notified that :element is required
     */
    public function iShouldBeNotifiedThatElementIsRequired($element)
    {
        /** @var CreatePageInterface|UpdatePageInterface $currentPage */
        $currentPage = $this->currentPageResolver->getCurrentPageWithForm([$this->createPage, $this->updatePage]);

        $this->assertFieldValidationMessage($currentPage, $element, sprintf('Please enter make %s.', $element));
    }

    /**
     * @Then /^(this make) should still be named "([^"]+)"$/
     */
    public function thisMakeNameShouldBe(MakeInterface $make, $makeName)
    {
        $this->iWantToBrowseMakes();

        Assert::true(
            $this->indexPage->isSingleResourceOnPage([
                'id' => $make->getId(),
                'name' => $makeName,
            ]),
            sprintf('Make name %s has not been assigned properly.', $makeName)
        );
    }
}
