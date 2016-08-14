<?php

namespace Behat\Context\Transform;

use Behat\Behat\Context\Context;
use FOS\UserBundle\Doctrine\UserManager;
use Webmozart\Assert\Assert;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class SpotterContext implements Context
{
    /**
     * @var UserManager
     */
    private $userManager;

    /**
     * @param UserManager $userManager
     */
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @Transform :spotter
     */
    public function getSpotterByUsername($username)
    {
        $spotter = $this->userManager->findUserByUsername($username);

        Assert::notNull(
            $spotter,
            sprintf('Spotter "%s" does not exist', $username)
        );

        return $spotter;
    }
}
