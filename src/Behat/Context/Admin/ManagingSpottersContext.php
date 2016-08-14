<?php

namespace Behat\Context\Admin;

use AppBundle\Entity\SpotterInterface;
use Behat\Context\BaseContext;
use Behat\Page\Admin\Crud\IndexPageInterface;
use Webmozart\Assert\Assert;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class ManagingSpottersContext extends BaseContext
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
     * @When I want to browse spotters
     */
    public function iWantToBrowseSpotters()
    {
        $this->indexPage->open();
    }

    /**
     * @Then I should see :numberOfSpotters spotters in the list
     */
    public function iShouldSeeSpottersInTheList($numberOfSpotters)
    {
        $foundRows = $this->indexPage->countItems();

        Assert::eq(
            $numberOfSpotters,
            $foundRows,
            '%s rows with spotters should appear on page, %s rows has been found'
        );
    }

    /**
     * @When I delete the spotter :spotter
     */
    public function iDeleteTheSpotter(SpotterInterface $spotter)
    {
        $this->indexPage->open();
        $this->indexPage->deleteResourceOnPage(['email' => $spotter->getEmail()]);
    }

    /**
     * @Then I should see the spotter :username in the list
     */
    public function iShouldSeeTheSpotterInTheList($username)
    {
        $this->iWantToBrowseSpotters();

        Assert::true(
            $this->indexPage->isSingleResourceOnPage(['username' => $username]),
            sprintf('Spotter %s has not been found.', $username)
        );
    }

    /**
     * @Then the spotter :username should no longer exist in the registry
     */
    public function theSpotterShouldNoLongerExistInTheRegistry($username)
    {
        Assert::false(
            $this->indexPage->isSingleResourceOnPage(['username' => $username]),
            sprintf('Spotter %s exists but should not.', $username)
        );
    }
}
