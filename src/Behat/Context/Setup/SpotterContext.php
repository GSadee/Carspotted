<?php

namespace Behat\Context\Setup;

use Behat\Behat\Context\Context;
use Behat\Service\SharedStorageInterface;
use FOS\UserBundle\Doctrine\UserManager;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class SpotterContext implements Context
{
    /**
     * @var SharedStorageInterface
     */
    private $sharedStorage;

    /**
     * @var UserManager
     */
    private $userManager;

    /**
     * @param SharedStorageInterface $sharedStorage
     * @param UserManager $userManager
     */
    public function __construct(SharedStorageInterface $sharedStorage, UserManager $userManager)
    {
        $this->sharedStorage = $sharedStorage;
        $this->userManager = $userManager;
    }

    /**
     * @Given /^there is(?:| also) a (?:spotter|user) "([^"]*)" with an email "([^"]*)" and a password "([^"]*)"$/
     * @Given /^there is(?:| also) a (?:spotter|user) "([^"]*)" with an email "([^"]*)"$/
     */
    public function thereIsUserWithPassword($username, $email, $password = 'resu')
    {
        $this->createSpotter($username, $email, $password, ['ROLE_USER']);
    }

    /**
     * @Given /^there is(?:| also) an admin "([^"]*)" with an email "([^"]*)" and a password "([^"]*)"$/
     */
    public function thereIsAdminWithPassword($username, $email, $password)
    {
        $this->createSpotter($username, $email, $password, ['ROLE_ADMIN']);
    }

    /**
     * @param string $username
     * @param string $email
     * @param string $password
     * @param array $roles
     * @param bool $enabled
     */
    private function createSpotter($username, $email, $password = 'password', $roles = [], $enabled = true)
    {
        $spotter = $this->userManager->createUser();
        $spotter->setUsername($username);
        $spotter->setEmail($email);
        $spotter->setPlainPassword($password);
        $spotter->setRoles($roles);
        $spotter->setEnabled($enabled);

        $this->sharedStorage->set('spotter', $spotter);

        $this->userManager->updateUser($spotter);
    }
}
