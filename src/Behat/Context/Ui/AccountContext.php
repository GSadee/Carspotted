<?php

namespace Behat\Context\Ui;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Page\Account\LoginPageInterface;
use Behat\Page\Account\RegisterConfirmationPageInterface;
use Behat\Page\Account\RegisterPageInterface;
use Behat\Page\HomePageInterface;
use Behat\Service\Resolver\CurrentPageResolverInterface;
use Behat\Service\SharedStorageInterface;
use Webmozart\Assert\Assert;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class AccountContext implements Context
{
    /**
     * @var LoginPageInterface
     */
    private $loginPage;

    /**
     * @var RegisterPageInterface
     */
    private $registerPage;

    /**
     * @var RegisterConfirmationPageInterface
     */
    private $registerConfirmationPage;

    /**
     * @var HomePageInterface
     */
    private $homePage;

    /**
     * @var CurrentPageResolverInterface
     */
    private $currentPageResolver;

    /**
     * @var SharedStorageInterface
     */
    private $sharedStorage;

    /**
     * @param LoginPageInterface $loginPage
     * @param RegisterPageInterface $registerPage
     * @param RegisterConfirmationPageInterface $registerConfirmationPage
     * @param HomePageInterface $homePage
     * @param CurrentPageResolverInterface $currentPageResolver
     * @param SharedStorageInterface $sharedStorage
     */
    public function __construct(
        LoginPageInterface $loginPage,
        RegisterPageInterface $registerPage,
        RegisterConfirmationPageInterface $registerConfirmationPage,
        HomePageInterface $homePage,
        CurrentPageResolverInterface $currentPageResolver,
        SharedStorageInterface $sharedStorage
    ) {
        $this->loginPage = $loginPage;
        $this->registerPage = $registerPage;
        $this->registerConfirmationPage = $registerConfirmationPage;
        $this->homePage = $homePage;
        $this->currentPageResolver = $currentPageResolver;
        $this->sharedStorage = $sharedStorage;
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
        /** @var LoginPageInterface|RegisterPageInterface $currentPage */
        $currentPage = $this->currentPageResolver->getCurrentPageWithForm([$this->loginPage, $this->registerPage]);

        $currentPage->specifyUsername($username);
    }

    /**
     * @When I specify the password as :password
     */
    public function iSpecifyPassword($password)
    {
        /** @var LoginPageInterface|RegisterPageInterface $currentPage */
        $currentPage = $this->currentPageResolver->getCurrentPageWithForm([$this->loginPage, $this->registerPage]);

        $currentPage->specifyPassword($password);

        $this->sharedStorage->set('password', $password);
    }

    /**
     * @When I sign in
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
        $this->homePage->open();

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
     * @Then I should be on the homepage
     */
    public function iShouldBeOnTheHomepage()
    {
        Assert::true(
            $this->homePage->isOpen(),
            'I should be on the homepage, but I am not.'
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

    /**
     * @Given I want to register a new account
     */
    public function iWantToRegisterNewAccount()
    {
        $this->registerPage->open();
    }

    /**
     * @When I specify the email as :email
     */
    public function iSpecifyEmail($email)
    {
        $this->registerPage->specifyEmail($email);
    }

    /**
     * @When /^I confirm (this password)$/
     */
    public function iConfirmThisPassword($password)
    {
        $this->registerPage->confirmPassword($password);
    }

    /**
     * @Given I register this account
     */
    public function iRegisterThisAccount()
    {
        $this->registerPage->register();
    }

    /**
     * @Then I should be on the register confirmation page
     */
    public function iShouldBeOnTheRegisterConfirmationPage()
    {
        Assert::true(
            $this->registerConfirmationPage->isOpen(),
            'I should be on the register confirmation page, but I am not.'
        );
    }

    /**
     * @Then /^I should be notified that new account has been successfully created$/
     */
    public function iShouldBeNotifiedThatNewAccountHasBeenSuccessfullyCreated()
    {
        Assert::true(
            $this->registerConfirmationPage->hasText('your account is now activated.'),
            'I should see register confirmation.'
        );
    }
}
