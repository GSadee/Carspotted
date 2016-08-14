<?php

namespace Behat\Context\Admin;

use Behat\Context\BaseContext;
use Behat\Page\Admin\DashboardPageInterface;
use Webmozart\Assert\Assert;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class DashboardContext extends BaseContext
{
    /**
     * @var DashboardPageInterface
     */
    private $dashboardPage;

    /**
     * @param DashboardPageInterface $dashboardPage
     */
    public function __construct(DashboardPageInterface $dashboardPage)
    {
        $this->dashboardPage = $dashboardPage;
    }

    /**
     * @When I view the admin dashboard
     */
    public function iViewAdminDashboard()
    {
        $this->dashboardPage->open();
    }

    /**
     * @Then I should see a text :text
     */
    public function iShouldSeeText($text)
    {
        Assert::contains(
            $this->dashboardPage->getHeader(),
            $text,
            'The text: %2$s cannot be found on page.'
        );
    }

    /**
     * @Then I should see :numberOfSpots spots in the list
     */
    public function iShouldSeeSpotsInTheList($numberOfSpots)
    {
        $foundRows = $this->dashboardPage->countSpots();

        Assert::eq(
            $numberOfSpots,
            $foundRows,
            '%s rows with spots should appear on page, %s rows has been found'
        );
    }
}
