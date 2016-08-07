<?php

namespace Behat\Page\Account;

use Behat\Page\SymfonyPageInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface RegisterPageInterface extends SymfonyPageInterface
{
    /**
     * @param string $username
     */
    public function specifyUsername($username);

    /**
     * @param string $password
     */
    public function specifyPassword($password);

    /**
     * @param string $email
     */
    public function specifyEmail($email);

    public function register();

    /**
     * @param string $password
     */
    public function confirmPassword($password);
}
