<?php

namespace Behat\Context\Admin;

use AppBundle\Entity\MakeInterface;
use AppBundle\Entity\ModelInterface;
use Behat\Context\BaseContext;
use Behat\Page\Admin\Crud\IndexPageInterface;
use Behat\Page\Admin\Model\CreatePageInterface;
use Behat\Page\Admin\Model\UpdatePageInterface;
use Behat\Service\Resolver\CurrentPageResolverInterface;
use Webmozart\Assert\Assert;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class ManagingModelsContext extends BaseContext
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
     * @When I want to browse models
     */
    public function iWantToBrowseModels()
    {
        $this->indexPage->open();
    }

    /**
     * @Then I should see :numberOfModels models in the list
     */
    public function iShouldSeeModelsInTheList($numberOfModels)
    {
        $foundRows = $this->indexPage->countItems();

        Assert::eq(
            $numberOfModels,
            $foundRows,
            '%s rows with models should appear on page, %s rows has been found'
        );
    }

    /**
     * @Then I should see the model named :modelName in the list
     * @Then the model :modelName should appear in the registry
     */
    public function iShouldSeeTheModelInTheList($modelName)
    {
        $this->iWantToBrowseModels();

        Assert::true(
            $this->indexPage->isSingleResourceOnPage(['name' => $modelName]),
            sprintf('Model with name %s has not been found.', $modelName)
        );
    }

    /**
     * @Then the model :modelName should no longer exist in the registry
     */
    public function theModelShouldNoLongerExistInTheRegistry($modelName)
    {
        Assert::false(
            $this->indexPage->isSingleResourceOnPage(['name' => $modelName]),
            sprintf('Model with name %s exists but should not.', $modelName)
        );
    }

    /**
     * @When I want to add a new model
     */
    public function iWantToAddANewModel()
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
     * @When I choose :makeName as a make
     * @When I do not choose a make
     */
    public function iChooseMake($makeName = null)
    {
        $this->createPage->chooseMake($makeName);
    }

    /**
     * @When I change a make to :makeName
     */
    public function iChangeMake($makeName)
    {
        $this->updatePage->chooseMake($makeName);
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
     * @When I want to modify the model :model
     * @When /^I want to modify (this model)$/
     */
    public function iWantToModifyMake(ModelInterface $model)
    {
        $this->updatePage->open(['id' => $model->getId()]);
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
     * @Then /^(this model) ([^"]+) should be "([^"]+)"$/
     */
    public function thisModelElementShouldBe(ModelInterface $model, $element, $value)
    {
        $this->iWantToBrowseModels();

        Assert::true(
            $this->indexPage->isSingleResourceOnPage([
                'id' => $model->getId(),
                $element => $value,
            ]),
            sprintf('Model %s should be %s', $element, $value)
        );
    }

    /**
     * @When I delete the model :model
     */
    public function iDeleteTheModel(ModelInterface $model)
    {
        $this->indexPage->open();
        $this->indexPage->deleteResourceOnPage(['name' => $model->getName()]);
    }

    /**
     * @Then I should be notified that :element is required
     */
    public function iShouldBeNotifiedThatElementIsRequired($element)
    {
        /** @var CreatePageInterface|UpdatePageInterface $currentPage */
        $currentPage = $this->currentPageResolver->getCurrentPageWithForm([$this->createPage, $this->updatePage]);

        $this->assertFieldValidationMessage($currentPage, $element, sprintf('Please enter model %s.', $element));
    }

    /**
     * @Then /^(this model) should still be named "([^"]+)"$/
     */
    public function thisModelNameShouldBe(ModelInterface $model, $modelName)
    {
        $this->iWantToBrowseModels();

        Assert::true(
            $this->indexPage->isSingleResourceOnPage([
                'id' => $model->getId(),
                'name' => $modelName,
            ]),
            sprintf('Model name %s has not been assigned properly.', $modelName)
        );
    }
}
