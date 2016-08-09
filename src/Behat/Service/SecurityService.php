<?php

namespace Behat\Service;

use AppBundle\Entity\SpotterInterface;
use Behat\Service\Setter\CookieSetterInterface;
use FOS\UserBundle\Doctrine\UserManager;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Webmozart\Assert\Assert;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Kamil Kokot <kamil.kokot@lakion.com>
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class SecurityService implements SecurityServiceInterface
{
    /**
     * @var UserManager
     */
    private $userManager;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var CookieSetterInterface
     */
    private $cookieSetter;

    /**
     * @var string
     */
    private $sessionTokenVariable;

    /**
     * @param UserManager $userManager
     * @param SessionInterface $session
     * @param CookieSetterInterface $cookieSetter
     * @param string $contextKey
     */
    public function __construct(
        UserManager $userManager,
        SessionInterface $session,
        CookieSetterInterface $cookieSetter,
        $contextKey
    ) {
        $this->userManager = $userManager;
        $this->session = $session;
        $this->cookieSetter = $cookieSetter;
        $this->sessionTokenVariable = sprintf('_security_%s', $contextKey);
    }

    /**
     * {@inheritdoc}
     */
    public function logIn($username)
    {
        /** @var SpotterInterface $spotter */
        $spotter = $this->userManager->findUserByUsername($username);

        Assert::notNull(
            $spotter,
            sprintf('There is no spotter with username %s', $username)
        );

        $this->logUserIn($spotter);
    }

    public function logOut()
    {
        $this->setSerializedToken(null);

        $this->cookieSetter->setCookie($this->session->getName(), $this->session->getId());
    }

    /**
     * @param SpotterInterface $spotter
     */
    private function logUserIn(SpotterInterface $spotter)
    {
        $token = new UsernamePasswordToken($spotter, $spotter->getPlainPassword(), 'randomstringbutnotnull', $spotter->getRoles());
        $serializedToken = serialize($token);

        $this->setSerializedToken($serializedToken);

        $this->cookieSetter->setCookie($this->session->getName(), $this->session->getId());
    }

    /**
     * @param string $token
     */
    private function setSerializedToken($token)
    {
        $this->session->set($this->sessionTokenVariable, $token);
        $this->session->save();
    }
}
