<?php

namespace Behat\Context\Ui;

use Behat\Context\BaseContext;
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
final class AccountContext extends BaseContext
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
     * @When I do not specify the username
     */
    public function iSpecifyUsername($username = null)
    {
        /** @var LoginPageInterface|RegisterPageInterface $currentPage */
        $currentPage = $this->currentPageResolver->getCurrentPageWithForm([$this->loginPage, $this->registerPage]);

        $currentPage->specifyUsername($username);
    }

    /**
     * @When I specify the password as :password
     * @When I do not specify the password
     */
    public function iSpecifyPassword($password = null)
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
     * @When I do not specify the email
     */
    public function iSpecifyEmail($email = null)
    {
        $this->registerPage->specifyEmail($email);
    }

    /**
     * @When /^I confirm (this password)$/
     * @When I do not confirm the password
     */
    public function iConfirmThisPassword($password = null)
    {
        $this->registerPage->confirmPassword($password);
    }

    /**
     * @When I register this account
     * @When I try to register this account
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

    /**
     * @Then I should be notified that the email is already used
     */
    public function iShouldBeNotifiedThatTheEmailIsAlreadyUsed()
    {
        $this->assertFieldValidationMessage($this->registerPage, 'email', 'The email is already used');
    }

    /**
     * @Then I should be notified that the username is required
     */
    public function iShouldBeNotifiedThatTheUsernameIsRequired()
    {
        $this->assertFieldValidationMessage($this->registerPage, 'username', 'Please enter a username');
    }

    /**
     * @Then I should be notified that the email is required
     */
    public function iShouldBeNotifiedThatTheEmailIsRequired()
    {
        $this->assertFieldValidationMessage($this->registerPage, 'email', 'Please enter an email');
    }

    /**
     * @Then I should be notified that the password is required
     */
    public function iShouldBeNotifiedThatThePasswordIsRequired()
    {
        $this->assertFieldValidationMessage($this->registerPage, 'password', 'Please enter a password');
    }

    /**
     * @Then I should be notified that the password do not match
     */
    public function iShouldBeNotifiedThatThePasswordDoNotMatch()
    {
        $this->assertFieldValidationMessage($this->registerPage, 'password', 'The entered passwords don\'t match');
    }
}
