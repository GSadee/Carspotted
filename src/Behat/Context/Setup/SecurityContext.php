<?php

namespace Behat\Context\Setup;

use AppBundle\Entity\SpotterInterface;
use Behat\Behat\Context\Context;
use Behat\Service\SecurityServiceInterface;
use Behat\Service\SharedStorageInterface;
use FOS\UserBundle\Doctrine\UserManager;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class SecurityContext implements Context
{
    /**
     * @var SharedStorageInterface
     */
    private $sharedStorage;

    /**
     * @var SecurityServiceInterface
     */
    private $securityService;

    /**
     * @var UserManager
     */
    private $userManager;

    /**
     * @param SharedStorageInterface $sharedStorage
     * @param SecurityServiceInterface $securityService
     * @param UserManager $userManager
     */
    public function __construct(
        SharedStorageInterface $sharedStorage,
        SecurityServiceInterface $securityService,
        UserManager $userManager
    ) {
        $this->sharedStorage = $sharedStorage;
        $this->securityService = $securityService;
        $this->userManager = $userManager;
    }

    /**
     * @Given I am logged in as :username
     */
    public function iAmLoggedInAs($username)
    {
        $this->securityService->logIn($username);
    }

    /**
     * @Given I am logged in as an administrator
     */
    public function iAmLoggedInAsAnAdministrator()
    {
        $admin = $this->userManager->findUserByUsername('admin');
        if (null === $admin) {
            $admin = $this->createSpotter('admin', 'admin@carspotted.com', 'nimda', ['ROLE_ADMIN']);
        }

        $this->securityService->logIn($admin->getUsername());

        $this->sharedStorage->set('admin', $admin);
    }

    /**
     * @param string $username
     * @param string $email
     * @param string $password
     * @param array $roles
     * @param bool $enabled
     *
     * @return SpotterInterface
     */
    private function createSpotter($username, $email, $password, $roles = [], $enabled = true)
    {
        $spotter = $this->userManager->createUser();
        $spotter->setUsername($username);
        $spotter->setEmail($email);
        $spotter->setPlainPassword($password);
        $spotter->setRoles($roles);
        $spotter->setEnabled($enabled);

        $this->sharedStorage->set('spotter', $spotter);

        $this->userManager->updateUser($spotter);

        return $spotter;
    }
}
