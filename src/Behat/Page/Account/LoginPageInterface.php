<?php

namespace Behat\Page\Account;

use Behat\Page\SymfonyPageInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface LoginPageInterface extends SymfonyPageInterface
{
    /**
     * @param string $password
     */
    public function specifyPassword($password);

    /**
     * @param string $username
     */
    public function specifyUsername($username);

    public function signIn();

    /**
     * @param string $message
     *
     * @return bool
     */
    public function hasValidationErrorWith($message);
}
