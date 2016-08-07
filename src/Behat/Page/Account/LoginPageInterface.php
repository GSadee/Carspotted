<?php

namespace Behat\Page\Account;

use Behat\Page\SymfonyPageInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface LoginPageInterface extends SymfonyPageInterface
{
    /**
     * @param string $username
     */
    public function specifyUsername($username);

    /**
     * @param string $password
     */
    public function specifyPassword($password);

    public function signIn();

    /**
     * @param string $message
     *
     * @return bool
     */
    public function hasValidationErrorWith($message);
}
