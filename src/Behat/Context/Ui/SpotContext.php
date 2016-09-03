<?php

namespace Behat\Context\Ui;

use AppBundle\Entity\SpotInterface;
use Behat\Context\BaseContext;
use Behat\Page\Spot\CreatePageInterface;
use Behat\Page\Spot\IndexBySpotterPageInterface;
use Behat\Page\Spot\IndexPageInterface;
use Behat\Page\Spot\ShowPageInterface;
use Behat\Service\NotificationCheckerInterface;
use Behat\Service\SharedStorageInterface;
use Behat\Type\NotificationType;
use Webmozart\Assert\Assert;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class SpotContext extends BaseContext
{
    /**
     * @var CreatePageInterface
     */
    private $createPage;

    /**
     * @var IndexPageInterface
     */
    private $indexPage;

    /**
     * @var IndexBySpotterPageInterface
     */
    private $indexBySpotterPage;

    /**
     * @var ShowPageInterface
     */
    private $showPage;

    /**
     * @var NotificationCheckerInterface
     */
    private $notificationChecker;

    /**
     * @param CreatePageInterface $createPage
     * @param IndexPageInterface $indexPage
     * @param IndexBySpotterPageInterface $indexBySpotterPage
     * @param ShowPageInterface $showPage
     * @param NotificationCheckerInterface $notificationChecker
     */
    public function __construct(
        CreatePageInterface $createPage,
        IndexPageInterface $indexPage,
        IndexBySpotterPageInterface $indexBySpotterPage,
        ShowPageInterface $showPage,
        NotificationCheckerInterface $notificationChecker
    ) {
        $this->createPage = $createPage;
        $this->indexPage = $indexPage;
        $this->indexBySpotterPage = $indexBySpotterPage;
        $this->showPage = $showPage;
        $this->notificationChecker = $notificationChecker;
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
     * @Then the spot :car should appear in the list of my spots
     */
    public function iShouldSeeCarInTheList($car)
    {
        $this->iWantToBrowseMySpots();

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

    /**
     * @When /^I want to view details of (this spot)$/
     */
    public function iWantToViewDetailsOfThisSpot(SpotInterface $spot)
    {
        $this->showPage->open(['id' => $spot->getId()]);
    }

    /**
     * @Then I should see the car name :car
     */
    public function iShouldSeeTheCarName($car)
    {
        Assert::same(
            $car,
            $this->showPage->getCarName(),
            'Car name should be %s, but it is %s.'
        );
    }

    /**
     * @Then I should also see the spotter :spotterUsername
     */
    public function iShouldAlsoSeeTheSpotter($spotterUsername)
    {
        Assert::same(
            $spotterUsername,
            $this->showPage->getSpotterUsername(),
            'This spot should be spotted by %s, but it is by %s.'
        );
    }

    /**
     * @When I want to add a new spot
     */
    public function iWantToAddANewSpot()
    {
        $this->createPage->open();
    }

    /**
     * @When I choose :makeName as a make
     */
    public function iChooseMake($makeName)
    {
        $this->createPage->chooseMake($makeName);
    }

    /**
     * @When I choose :modelName as a model
     */
    public function iChooseModel($modelName)
    {
        $this->createPage->chooseModel($modelName);
    }

    /**
     * @When I specify the latitude as :latitude
     */
    public function iSpecifyTheLatitudeAs($latitude)
    {
        $this->createPage->specifyLatitude($latitude);
    }

    /**
     * @When I specify the longitude as :longitude
     */
    public function iSpecifyTheLongitudeAs($longitude)
    {
        $this->createPage->specifyLongitude($longitude);
    }

    /**
     * @When I specify the country as :country
     */
    public function iSpecifyTheCountryAs($country)
    {
        $this->createPage->specifyCountry($country);
    }

    /**
     * @When I specify the city as :city
     */
    public function iSpecifyTheCityAs($city)
    {
        $this->createPage->specifyCity($city);
    }

    /**
     * @When I add it
     */
    public function iAddIt()
    {
        $this->createPage->create();
    }

    /**
     * @Then I should be notified that it has been successfully added
     */
    public function iShouldBeNotifiedThatItHasBeenSuccessfullyAdded()
    {
        $this->notificationChecker->checkNotification('has been successfully added.', NotificationType::success());
    }

    /**
     * @Then I attach the photo :path
     */
    public function iAttachThePhoto($path)
    {
        $this->createPage->attachPhoto($path);
    }

    /**
     * @Then /^(the spot "[^"]+" "[^"]+") should have a photo$/
     */
    public function thisSpotShouldHaveAPhoto(SpotInterface $spot)
    {
        Assert::notNull(
            $spot->getFirstPhoto()->getPath(),
            'This spot does not have a photo.'
        );
    }
}
