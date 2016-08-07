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
     * @Given /^there is a (?:spotter|user) "([^"]*)" with an email "([^"]*)" and a password "([^"]*)"$/
     */
    public function thereIsUserWithPassword($username, $email, $password)
    {
        $this->createSpotter($username, $email, $password, ['ROLE_USER']);
    }

    /**
     * @param string $username
     * @param string $email
     * @param string $password
     * @param array $roles
     * @param bool $enabled
     */
    private function createSpotter($username, $email, $password, $roles = [], $enabled = true)
    {
        $user = $this->userManager->createUser();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPlainPassword($password);
        $user->setRoles($roles);
        $user->setEnabled($enabled);

        $this->sharedStorage->set('user', $user);

        $this->userManager->updateUser($user);
    }
}
