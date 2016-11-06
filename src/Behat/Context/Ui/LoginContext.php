<?php

namespace Behat\Context\Ui;

use Behat\Context\BaseContext;
use Behat\Page\Account\LoginPageInterface;
use Behat\Page\HomePageInterface;
use Webmozart\Assert\Assert;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class LoginContext extends BaseContext
{
    /**
     * @var LoginPageInterface
     */
    private $loginPage;

    /**
     * @var HomePageInterface
     */
    private $homePage;

    /**
     * @param LoginPageInterface $loginPage
     * @param HomePageInterface $homePage
     */
    public function __construct(
        LoginPageInterface $loginPage,
        HomePageInterface $homePage
    ) {
        $this->loginPage = $loginPage;
        $this->homePage = $homePage;
    }

    /**
     * @Given I want to sign in
     */
    public function iWantToSignIn()
    {
        $this->loginPage->open();
    }

    /**
     * @When I specify the username as :username
     */
    public function iSpecifyUsername($username)
    {
        $this->loginPage->specifyUsername($username);
    }

    /**
     * @When I specify the password as :password
     */
    public function iSpecifyPassword($password)
    {
        $this->loginPage->specifyPassword($password);
    }

    /**
     * @When I sign in
     * @When I try to sign in
     */
    public function iSignIn()
    {
        $this->loginPage->signIn();
    }

    /**
     * @Then I should be logged in
     */
    public function iShouldBeLoggedIn()
    {
        Assert::true(
            $this->homePage->hasLogoutButton(),
            'I should be able to sign out.'
        );
    }

    /**
     * @Then I should not be logged in
     */
    public function iShouldNotBeLoggedIn()
    {
        Assert::false(
            $this->homePage->hasLogoutButton(),
            'I should not be signed in.'
        );
    }

    /**
     * @Then I should be notified about invalid credentials
     */
    public function iShouldBeNotifiedAboutBadCredentials()
    {
        Assert::true(
            $this->loginPage->hasValidationErrorWith('Invalid credentials.'),
            'I should see validation error.'
        );
    }
}
