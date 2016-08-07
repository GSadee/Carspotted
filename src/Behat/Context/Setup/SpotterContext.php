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
        $user = $this->userManager->createUser();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPlainPassword($password);

        $this->sharedStorage->set('user', $user);

        $this->userManager->updateUser($user);
    }
}
